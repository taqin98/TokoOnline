<?php

					$provinsi_id = $_GET['prov_id'];

					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$provinsi_id",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => "",
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => "GET",
						CURLOPT_HTTPHEADER => array(
							"key: 1376e153b9b9c474f07901ed26d710ae"
						),
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);

					curl_close($curl);

					if ($err) {
						echo "cURL Error #:" . $err;
					} else {
  //echo $response;
					}

					$data = json_decode($response, true);
					for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
						?>
						<input type="text" name="nama_kab" value="<?php echo $data['rajaongkir']['results'][$i]['type']." ".$data['rajaongkir']['results'][$i]['city_name']; ?>">
						<?php

					}


					?>