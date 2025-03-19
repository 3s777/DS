<?php

namespace Support\Actions;

use Illuminate\Support\Facades\DB;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;
use Throwable;

class MassDeletingAction
{
    public function __invoke(MassDeletingDTO $data)
    {
        $selectedIdsArray = explode(",", $data->ids);

        try {
            DB::transaction(function () use ($selectedIdsArray, $data) {

                foreach ($selectedIdsArray as $id) {
                    if (is_numeric($id)) {
                        if ($data->isForce) {
                            $data->modelNamespace::find($id)->forceDelete();
                        } else {
                            $data->modelNamespace::find($id)->delete();
                        }
                    }
                }
            });
        } catch (Throwable $e) {
            throw new MassDeletingException($e->getMessage());
        }
    }
}
