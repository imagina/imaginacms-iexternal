<?php

namespace Modules\Iexternal\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
use Illuminate\Http\Request;
//Model
use Modules\Iexternal\Entities\SyncModel;
use Modules\Iexternal\Repositories\SyncModelRepository;
use Modules\Iexternal\Http\Requests\SyncExternalRequest;

class SyncModelApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(SyncModel $model, SyncModelRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }

  public function syncModel(Request $request, $modelSystemName)
  {
    \DB::beginTransaction();
    try {
      //Validate attributes
      $attributes = $request->input('attributes');
      $this->validateRequestApi(new SyncExternalRequest($attributes));

      //Get syncModel
      $syncModel = $this->modelRepository->getItem(
        $modelSystemName,
        json_decode(json_encode(['filter' => ['field' => 'system_name']]))
      );

      //Validate the provider
      if (!$syncModel || !$syncModel->status) throw new \Exception('Sync Model is Invalid', 204);

      //Get provider
      $providerRepository = app('Modules\Iexternal\Repositories\ProviderRepository');
      $provider = $providerRepository->getItem(
        $attributes['provider'],
        json_decode(json_encode(['filter' => ['field' => 'system_name']]))
      );

      //Search if item already is related
      $externalRepository = app('Modules\Iexternal\Repositories\ExternalRepository');
      $external = $externalRepository->getItem(
        $attributes['id'],
        json_decode(json_encode(['filter' => [
          'field' => 'external_id',
          'provider_id' => $provider->id,
          'entity_type' => $syncModel->entity_path
        ]]))
      );

      //Update or create model and sync external
      $syncModelRepository = app($syncModel->repository_path);
      if ($external) {
        if(isset($attributes['data']['password'])) unset($attributes['data']['password']);
        $response = $syncModelRepository->updateBy($external->entity_id, $attributes['data'], ['sync' => true]);
      } else {
        $response = $syncModelRepository->create($attributes['data']);
        $externalRepository->create([
          'entity_type' => $syncModel->entity_path,
          'entity_id' => $response->id,
          'provider_id' => $provider->id,
          'external_id' => $attributes['id'],
        ]);
      }
      \DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback(); //Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ['messages' => [['message' => $e->getMessage(), 'type' => 'error']]];
    }
    //Return response
    return response()->json($response ?? ['data' => 'Request successful'], $status ?? 200);
  }
}
