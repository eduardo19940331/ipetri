<?php

namespace App\Http\Controllers\EFCActions;

use DateTime;
use App\Helper\HelperDate;
use App\Http\Entity\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class EFCController extends BaseController
{
    public function index()
    {
        return view('christianTraining.index');
    }

    public function getUsersData()
    {
        /** @var User[] */
        $users = User::where('status', '=', 1)->whereNull('deleted_at')->get();
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                "id" => $user->id,
                "rut" => $user->rut,
                "name" => $user->first_name . " " . $user->last_name,
                "phone" => $user->phone,
                "email" => $user->email
            ];
        }

        return json_encode(['data' => $data]);
    }

    public function getSeccionCreated(int $id = 0)
    {
        $user = User::find($id);

        if ($user) {
            $dateBirth = new DateTime($user->birthday);
            $dateArrival = new DateTime($user->arrivaldate);
            $user->birthdayFormat = $dateBirth->format("d/m/Y");
            $user->arrivalDateFormat = $dateArrival->format("d/m/Y");
        }

        return view('admin.user.new', [
            "usr" => $user
        ]);
    }

    public function userSave(Request $request)
    {
        $data = [];
        foreach ($request->get('data') as $input) {
            $data[$input["name"]] = $input["value"];
        }

        $validations = [
            "run" => "required",
            "first_name" => "required",
            "last_name" => "required",
            "sex" => "required",
            "email" => "required",
            "phone" => "required"
        ];

        $message = [
            "run.required" => "Campo :attribute debe ser ingresado",
            "first_name.required" => "Campo :attribute debe ser ingresado",
            "last_name.required" => "Campo :attribute debe ser ingresado",
            "sex.required" => "Campo :attribute debe ser ingresado",
            "email.required" => "Campo :attribute debe ser ingresado",
            "phone.required" => "Campo :attribute debe ser ingresado"
        ];

        $validator = Validator::make($data, $validations, $message);

        if ($validator->fails()) {
            return redirect('adminUserCreated')
                ->withErrors($validator)
                ->withInput();
        }

        $helperDate = new HelperDate();

        $user = User::find($data["id_user"]) ?? new User();
        $user->rut = $data["run"];
        $user->last_name = $data["last_name"];
        $user->first_name = $data["first_name"];
        $user->sex = $data["sex"];
        $user->phone = $data["phone"];
        $user->email = $data["email"];
        $user->arrivaldate = $helperDate->reverseDate($data["arrival_date"]);
        $user->birthday = $helperDate->reverseDate($data["birthdate"]);
        $user->save();

        return json_encode([
            "state" => "success",
            "message" => "Se han guardado los cambios correctamente"
        ], JSON_NUMERIC_CHECK);
    }

    public function removeUser(Request $request): json_encode
    {
        $user = User::find($request->get('id'));


        return json_encode([
            "state" => "success",
            "message" => "El usuario <b>" . $user->first_name . " " . $user->last_name . "</b> ha sido eliminado"
        ], JSON_NUMERIC_CHECK);
    }
}
