<form action="{{ route('storeDataRegistrationInpatient') }}" method="POST" id="FormDataRegistrationInpatient" enctype="multipart/form-data" files="true" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-content" style="display: none; margin-top: 13.5%;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title"><h2>Registrasi Rawat Inap</h2></div>
				<div class="form--top__btn">
				</div>
			</div>
			<div class="form--mid">
				<div class="create__form content__tab active__content">
					<div class="form__group__row">
						<div class="create__form__row">
							<span class="form__group__title">Informasi Pasien<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-1"><i>@include('schemars.svg-logo.ico-expand-arrow')</i></a>
							</span>
						</div>

						<div id="form-accordion-1">
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Nomer Registrasi</label>
									<div class="field__icon">
										<input type="text" class="form-control" id="form-filter-function-by-number" placeholder="Nomer registrasi" @keyup="searchFormDataByNumber">
									</div>
									<div class="form--error--message" id="form--error--message--registration_number"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>NIK</label>
									<div class="field__icon">
										<input value="@{{ models.nik }}" class="form-control" disabled="disabled">
									</div>
									<div class="form--error--message" id="form--error--message--fullname"></div>
								</div>
								<input type="hidden" name="registration_id" value="@{{ models.registration_id }}">
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Nama Pasien</label>
									<div class="field__icon">
										<input value="@{{ models.fullname }}" class="form-control" disabled="disabled">
									</div>
									<div class="form--error--message" id="form--error--message--fullname"></div>
								</div>
							</div>
						</div>

						<div class="create__form__row">
							<span class="form__group__title">Data Pasien Rawat Inap<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-2"><i>@include('schemars.svg-logo.ico-expand-arrow')</i></a>
							</span>
						</div>

						<div id="form-accordion-2">
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Penanggung Jawab</label>
									<div class="field__icon">
										<input name="person_in_charge" v-model="models.person_in_charge" class="form-control" placeholder="Nama Penanggung Jawab">
									</div>
									<div class="form--error--message" id="form--error--message--person_in_charge"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Hubungan Keluarga</label>
									<input name="relation_family" v-model="models.relation_family" class="form-control" placeholder="Jenis Hubungan Keluarga">
									<div class="form--error--message" id="form--error--message--relation_family"></div>
								</div>
							</div>
							
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Nomer Telepon</label>
									<input name="phone_number" v-model="models.phone_number" class="form-control" placeholder="Nomer Telepon">
									<div class="form--error--message" id="form--error--message--phone_number"></div>
								</div>
							</div>
							
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Jenis Rujukan</label>
									<select name="type_reference" class="form-control" v-model="models.type_reference">
										<option value="">Pilih Jenis Rujukan</option>
										<option value="1">Kemauan Sendiri</option>
										<option value="2">Rujukan Rs Lain</option>
										<option value="3">Rujukan Internal</option>
									</select>
									<div class="form--error--message" id="form--error--message--type_reference"></div>
								</div>
							</div>
							
							<div class="create__form__row" v-if="models.type_reference =='2'">
								<div class="new__form__field">
									<label>Nama Rumah Sakit</label>
									<input name="hospital_name" v-model="models.hospital_name" class="form-control" placeholder="Nama Rumah Sakit">
									<div class="form--error--message" id="form--error--message--hospital_name"></div>
								</div>
							</div>

							<div class="create__form__row" v-if="models.type_reference =='2'">
								<div class="new__form__field">
									<label>Keterangan Rujukan</label>
									<textarea name="description_reference" v-model="models.description_reference" class="form-control"></textarea>
									<div class="form--error--message" id="form--error--message--description_reference"></div>
								</div>
							</div>
							
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Keluhan / Penyakit</label>
									<textarea name="complaint_of_felt" v-model="models.complaint_of_felt" class="form-control"></textarea>
									<div class="form--error--message" id="form--error--message--complaint_of_felt"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Catatan</label>
									<textarea name="registration_note" v-model="models.registration_note" class="form-control"></textarea>
									<div class="form--error--message" id="form--error--message--registration_note"></div>
								</div>
							</div>
							
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Nama Ruangan</label>
									<select name="room_care_id" class="form-control" v-model="models.room_care_id">room_care
										<option value="">Pilih Ruangan Perawatan</option>
										<option v-for="room_care in responseData.room_care" :value="room_care.id">@{{ room_care.room_number }} | @{{ room_care.class }}</option>
									</select>
									<div class="form--error--message" id="form--error--message--room_care_id"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Dokter Ahli</label>
									<select name="doctor_id" class="form-control" v-model="models.doctor_id">
										<option value="">Pilih Dokter Perawatan</option>
										<option v-for="doctor in responseData.doctor" :value="doctor.id">@{{ doctor.fullname }}</option>
									</select>
									<div class="form--error--message" id="form--error--message--doctor_id"></div>
								</div>
							</div>

						</div>

					</div>
				</div>
			</div>

			<div class="form--bot">
				<div class="create__form">
					<div class="create__form__row flex-between">
						<div class="new__form__btn">
							<div class="form--top__btn">
								<a href="javascript:void(0);" class="btn__add__cancel" @click="resetForm">Cancel</a>
							</div>
						</div>

						<div class="new__form__btn">
							<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>