<div class="main__content__form__layer" id="toggle-detail-content" style="display: none; margin-top: 5%;">
	<div class="create__form__wrapper">
		<div class="form--top flex-between">
			<div class="form__title"><h2>Detail Pasien</h2></div>
			
		</div>
		<div class="form--mid">
			<div class="create__form content__tab active__content">
				<table align="center" cellpadding="0" cellspacing="0" class="table__style">
					<thead>
						<!-- header tabel -->
						<tr>
							<th style="text-align: left;">
								<b>Nama Lengkap</b>
								<br>
								@{{ models.fullname }}
							</th>
							<th>
								<b>Nomer Registrasi</b>
								<br>
								@{{ models.registration_number }}
							</th>
							<th>
								<b>NIK</b>
								<br>
								@{{ models.nik }}
							</th>
							<th>
								<b>Umur</b>
								<br>
								@{{ models.age }}
							</th>
							<th>
								<b>J. Kelamin</b>
								<br>
								<span v-if="models.gender == 'male'">Laki-laki</span>
								<span v-if="models.gender == 'female'">Perempuan</span>
							</th>
						</tr>
					</thead>
				</table>
				<table align="center" cellpadding="0" cellspacing="0" class="table__style">
					<thead>
						<tr>
							<th style="text-align: left;width: 22.7%;">
								<b>TGL. Registrasi</b>
								<br>
								@{{ models.registration_date }}
							</th>

							<th style="width: 25.2%;">
								<b>Telepon</b>
								<br>
								@{{ models.phone_number }}
							</th>

							<th>
								<b>Catatan</b>
								<br>
								<span v-if="models.description != false">@{{ models.description }}</span>
								<span v-if="models.description == false">Tidak ada catatan</span>
							</th>
						</tr>
					</thead>
				</table>
				<table align="center" cellpadding="0" cellspacing="0" class="table__style">
					<thead>
						<tr>
							<th style="text-align: left;">
								<b>Alamat</b>
								<br>
								@{{ models.street }}, @{{ models.districts }}, @{{ models.city }}, @{{ models.province }}
							</th>
						</tr>
						<!-- end isi tabel -->
					</thead>
				</table>
				<table align="center" cellpadding="0" cellspacing="0" class="table__style">
					<thead>
						<!-- header tabel -->
						<tr>
							<th class="fild" style="text-align: left;">
								<b>Tempat Lahir</b>
							</th>
							<th>
								@{{ models.place_of_birth }}
							</th>
						</tr>
						<tr>
							<th class="fild" style="text-align: left;">
								<b>Tanggal Lahir</b>
							</th>
							<th>
								@{{ models.date_of_birth }}
							</th>
						</tr>
						<tr>
							<th class="fild" style="text-align: left;">
								<b>Status Perkawinan</b>
							</th>
							<th>
								<span v-if="models.marital_status == '1'">Belum Menikah</span>
								<span v-if="models.marital_status == '2'">Sudah Menikah</span>
							</th>
						</tr>
						<tr>
							<th class="fild" style="text-align: left;">
								<b>Agama</b>
							</th>
							<th>
								<span v-if="models.religion == '1'">Islam</span>
								<span v-if="models.religion == '2'">Kristen Katolik</span>
								<span v-if="models.religion == '3'">Kristen Protestan</span>
								<span v-if="models.religion == '4'">Hindu</span>
								<span v-if="models.religion == '5'">Budha</span>
								<span v-if="models.religion == '6'">Lainnya</span>
							</th>
						</tr>
						<tr>
							<th class="fild" style="text-align: left;">
								<b>Pendidikan</b>
							</th>
							<th>
								@{{ models.education }}
							</th>
						</tr>
						<tr>
							<th class="fild" style="text-align: left;">
								<b>Pekerjaan</b>
							</th>
							<th>
								@{{ models.work }}
							</th>
						</tr>

						<tr>
							<th class="fild" style="text-align: left;">
								<b>Kewarganegaraan</b>
							</th>
							<th>
								<span v-if="models.citizen == '1'">WNI</span>
								<span v-if="models.citizen == '2'">WNA</span>
							</th>
						</tr>
						<tr v-if="models.citizen == '2'">
							<th class="fild" style="text-align: left;">
								<b>Negara</b>
							</th>
							<th>
								@{{ models.country }}
							</th>
						</tr>
						<tr>
							<th class="fild" style="text-align: left;">
								<b>Berat Badan</b>
							</th>
							<th>
								@{{ models.weight }} Kg
							</th>
						</tr>
						<tr>
							<th class="fild" style="text-align: left;">
								<b>Tinggi Badan</b>
							</th>
							<th>
								@{{ models.height }} CM
							</th>
						</tr>
						<tr>
							<th class="fild" style="text-align: left;">
								<b>Golongan Darah</b>
							</th>
							<th>
								@{{ models.blood }}
							</th>
						</tr>


					</thead>
				</table>
			</div>
		</div>
		<div class="form--bot">
			<div class="create__form">
				<div class="create__form__row flex-between">
					<div class="new__form__btn">
						<div class="form--top__btn">
							<a href="#" class="btn__add__cancel">Close</a>
						</div>
					</div>

					<div class="new__form__btn">
						<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
						<button class="btn__form" type="submit" @click="printData">Cetak</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>