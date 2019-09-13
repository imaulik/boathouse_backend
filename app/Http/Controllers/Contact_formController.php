<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Contact_form;
use Validator;

class Contact_formController extends BaseController
{

    public function __construct()
    {
        
    }

    public function SaveContact_form(Request $request)
    {
        $data = $request->all();
        if (isset($data))
        {
            if (isset($data['id']))
            {
                $contact_form = Contact_form::find($data['id']);
                if ($contact_form)
                {
                    $contact_form->update($data);
                    return $this->JSONformatSuccessResponse('Updated Successfully');
                } else
                {
                    return $this->JSONformatUnsuccessResponse('Please provide parameter');
                }
            } else
            {
                Contact_form::create($data);
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getContact_forms(Request $request)
    {
        $filter = $request->all();
        if (isset($filter))
        {
            $query = Contact_form::query();
            $totalrecords = $query->count();

            $query1 = Contact_form::query();
            $query1 = $query1->take($filter['rows'])
                    ->skip($filter['first']);
            $query1 = $query1->where(function ($qu2) use ($filter)
                    {
                        $qu2->orWhere('name', 'like', '%' . $filter['globalFilter'] . '%');
                    })
                    ->orderBy($filter['columns'], $filter['sortype']);
            $data = $query1->get();
            return $this->JSONformatSuccessResponse(compact('data', 'totalrecords'));
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getContact_formById(Request $request)
    {
        $data = $request->all();
        if ($request->id)
        {
            $contact_form = Contact_form::where('id', '=', $request->id)
                            ->first()->toArray();
            return $this->JSONformatSuccessResponse($contact_form);
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function deleteContact_form(Request $request)
    {
        if ($request->id)
        {
            Contact_form::where('id', $request->id)->delete();
            return $this->JSONformatSuccessResponse('Deleted Successfully');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function SaveContact_form_front(Request $request)
    {
        $data = $request->all();
        if (isset($data))
        {
            Contact_form::create($data);
            return $this->JSONformatSuccessResponse('Created Successfully');
        } else
        {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

}
