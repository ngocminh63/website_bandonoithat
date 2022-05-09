<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

class DeliveryController extends Controller
{
    public function delivery(Request $request){
        $city = City::orderby('matp','ASC')->get();

        return view('admin.add_delivery')->with(compact('city'));
    }

    //dùng ajax, thì khi chọn tỉnh thành phố, thì nó sẽ lọc theo tỉnh thành phố đã chọn để ra quận huyển rồi tương tự ra xã
    public function select_delivery(Request $request){
        $data = $request-> all();
        if($data['action']){
            $output = '';
            if($data['action']=='city'){                             //nếu là thành phố thì so sánh mã tp của bảng thành phố với matp ở bảng quận huyện
                $select_province= Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get(); //ma_id bên admin laypout gửi sang
                $output.='<option>---Chọn Quận/Huyện---</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->maqh.'">'.$province->name_qh.'</option>';   //đưa ra tên các quận huyện thuộc thành phố đó
                }
            }else{
                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option>---Chọn Xã/Phường---</option>';
    			foreach($select_wards as $key => $ward){
    				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xp.'</option>';
    			}

            }
            echo $output;
        }
    }
//Thêm dữ liệu vào bảng vận chuyển
    public function insert_delivery(Request $request){
        $data = $request->all();
		$fee_ship = new Feeship();                   //thêm bảng vẩn chuyển mới với các giá trị
		$fee_ship->fee_matp = $data['city'];
		$fee_ship->fee_maqh = $data['province'];
		$fee_ship->fee_xaid = $data['wards'];
		$fee_ship->fee_feeship = $data['fee_ship'];
		$fee_ship->save();
    }
//đưa dữ liệu đã thêm ra bảng giao diện admin
    public function select_feeship(){
		$feeship = Feeship::orderby('fee_id','DESC')->get();    //lấy dữ liệu sắp xếp theo mã fee_id sắp xếp theo giảm dần, thêm sau lên trước
		$output = '';                                           //khai báo và nối với table
		$output .= '<div class="table-responsive">              
			<table class="table table-bordered">
				<thread> 
					<tr>
						<th>Tên tỉnh/thành phố</th>
						<th>Tên quận/huyện</th> 
						<th>Tên xã/phường</th>
						<th>Phí ship</th>
					</tr>  
				</thread>
				<tbody>
				';
     //kết thúc khai báo cột
				foreach($feeship as $key => $fee){
        //kết nối dữ liệu, vào gián tiếp các bảng để lấy tên,contenteditable có thể sửa được
				$output.='                                            
					<tr>                                     
						<td>'.$fee->city->name_tp.'</td>
						<td>'.$fee->province->name_qh.'</td>
						<td>'.$fee->wards->name_xp.'</td>
						<td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
					</tr>
					';
				}

				$output.='		
				</tbody>
			</table></div>
			';

			echo $output;
	}
//Thay đổi phí vận chuyển trong bảng
    public function update_feeship(Request $request){
		$data = $request->all();
		$fee_ship = Feeship::find($data['feeship_id']);
		$fee_value = rtrim($data['fee_value'],'.');            //hàm rtrim để cắt dấu . trong giá phí
		$fee_ship->fee_feeship = $fee_value;
		$fee_ship->save();
	}
}
