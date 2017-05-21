<div class="main__content__form__layer" id="toggle-detail-content" style="display: none; margin-top: 5%;">
	<div class="create__form__wrapper">
		<div class="form--top flex-between">
			<div class="form__title"><h2>Detail Pasien</h2></div>
			<div class="form--top__btn">
				<a href="#" class="btn__add__cancel" @click="printData">Cetak</a>
			</div>
		</div>
		<div class="form--mid">
			<div class="create__form content__tab active__content">
				<table align="center" cellpadding="0" cellspacing="0" class="table__style">
					<tbody>
						<!-- header tabel -->
						<tr>
							<th>Nomer Registrasi</th>
							<th>NIK</th>
							<th>Nama Lengkap</th>
							<th>Tanggal Registrasi</th>
							<th>Tempat Lahir</th>
							<th>Tanggal Lahir</th>
							<th>Pendidikan</th>
							<th>Pekerjaan</th>
							<th>Agama</th>
							<th>Warganega</th>
							<th v-if="models.citizen == '2'">Negara Asal</th>
							<th>Status</th>
						</tr>
						<!-- isi tabel -->
						<tr>
							<td>@{{ models.registration_number }}</td>
							<td>@{{ models.nik }}</td>
							<td>@{{ models.fullname }}</td>
							<td>@{{ models.registration_date }}</td>
							<td>@{{ models.place_of_birth }}</td>
							<td>@{{ models.date_of_birth }}</td>
							<td>@{{ models.education }}</td>
							<td>@{{ models.work }}</td>
							<td>
								<span v-if="models.religion == '1'">Islam</span>
								<span v-if="models.religion == '2'">Kristen Katolik</span>
								<span v-if="models.religion == '3'">Kristen Protestan</span>
								<span v-if="models.religion == '4'">Hindu</span>
								<span v-if="models.religion == '5'">Budha</span>
								<span v-if="models.religion == '6'">Lainnya</span>
							</td>
							<td>
								<span v-if="models.citizen == '1'">WNI</span>
								<span v-if="models.citizen == '2'">WNA</span>
							</td>
							<td v-if="models.citizen == '2'">
								@{{ models.country }}
							</td>
							<td>
								<span v-if="models.marital_status =='1'">Belum Menikah</span>
								<span v-if="models.marital_status =='2'">Sudah Menikah</span>
							</td>
						</tr>
						<!-- end isi tabel -->
					</tbody>
				</table>
			</div>
		</div>

		<div class="form--top flex-between">
			<div class="form__title"><h2>Rekam Medis</h2></div>
		</div>

		<div class="form--mid">
			<div class="create__form content__tab active__content" v-for="record in medical_record">
				<div class="form__title"><h6><b>Tanggal Checkup : @{{ record.time_checkup }}</b></h6></div>
				<table align="center" cellpadding="0" cellspacing="0" class="table__style">
					<thead>
						<tr>
							<th>Dokter</th>
							<th>Poliklinik</th>
							<th>Detail</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div v-for="doctor in record.doctor">@{{ doctor.doctor_name }}</div>
							</td>
							<td>
								<div v-for="policlinic in record.policlinic">@{{ policlinic.policlinic_name }}</div>
							</td>
							<td>
								<div v-for="record_detail in record.record_detail">@{{ record_detail.medicament_name }}</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>