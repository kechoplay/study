<?php

namespace App\Http\Controllers;

use App\Model\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //
    public function profile(Request $request){
        $id = $request->get('idCustomer');
        $customer = Customer::find($id);
        // dd($customer);
        return view('customer.profile',compact('customer'));
    }
    public function formEditProfile(Request $request){
        $id = $request->get('idCustomer');
        $customer = Customer::find($id);
        // dd($customer);
        return view('customer.edit_profile',compact('customer'));
    }
    public function editProfile(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'image_customer' => ['image'],
            'name_customer' => ['required','string','max:32'],
            'address_customer' => ['required'],
            'email_customer' => ['required','email'],
            'phone_customer' => ['required','max:11'],
        ])->validate();
        $idCustomer = $request->get('idCustomer');
        $imageCustomer = $request->file('image_customer');
        $customer = Customer::find($idCustomer);
        if($imageCustomer){
            if($imageCustomer->getSize() < 100000){
                $nameImage = $imageCustomer->getClientOriginalName(); // lay ten goc file
                $currentImage = current(explode('.',$nameImage));
                $extensionImage = $imageCustomer->extension(); // lay duoi ten file
                $newImage = $currentImage.'.'.$extensionImage;
                if($imageCustomer->move('images/customer',$newImage)){
                    $customer->image_customer = $newImage;
                    $customer->name_customer = $data['name_customer'];
                    $customer->sex_customer = $data['sex_customer'];
                    $customer->address_customer = $data['address_customer'];
                    $customer->email_customer = $data['email_customer'];
                    $customer->phone_customer = $data['phone_customer'];
                    $checkCustomer = $customer->save();
                    if($checkCustomer){
                        Session::put('message_profile',"S???a th??ng tin ".$data['name_customer']." th??nh c??ng!");
                        return redirect()->route('customer.profile',['idCustomer' => $idCustomer]);// k s??? d???ng redirect::to. chuy???n th??nh redirect()->route('')
                    }else{
                        Session::put('message_profile',"S???a th??ng tin ".$data['name_customer']." th???t b???i!");
                        return redirect()->route('customer.formEditProfile',['idCustomer'=>$idCustomer]);// k s??? d???ng redirect::to. chuy???n th??nh redirect()->route('')
                    }
                }else{
                    Session::put('message_profile','Kh??ng th??m ???????c ???nh v??o folder!');
                    return redirect()->route('customer.profile',['idCustomer' => $idCustomer]);// k s??? d???ng redirect::to. chuy???n th??nh redirect()->route('')
                } // tr?????ng h???p move fail th?? sao?
            }else{
                Session::put('message_profile','K??ch th?????c ???nh v?????t qu?? 100KB');
                return redirect()->route('customer.profile',['idCustomer' => $idCustomer]);
            }
        }else{
            $customer->name_customer = $data['name_customer'];
            $customer->sex_customer = $data['sex_customer'];
            $customer->address_customer = $data['address_customer'];
            $customer->email_customer = $data['email_customer'];
            $customer->phone_customer = $data['phone_customer'];
            $checkCustomer = $customer->save();
            if($checkCustomer){
                Session::put('message_profile',"S???a th??ng tin ".$data['name_customer']." th??nh c??ng!");
                return redirect()->route('customer.profile',['idCustomer' => $idCustomer]);// k s??? d???ng redirect::to. chuy???n th??nh redirect()->route('')
            }else{
                Session::put('message_profile',"S???a th??ng tin ".$data['name_customer']." th???t b???i!");
                return redirect()->route('customer.formEditProfile',['idCustomer'=>$idCustomer]);// k s??? d???ng redirect::to. chuy???n th??nh redirect()->route('')
            }
        }
    }
}
