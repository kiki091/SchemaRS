<form action="{{ route('storeDataDoctor') }}" method="POST" id="FormDataDoctor" enctype="multipart/form-data" files="true" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-content" style="display: none; margin-top: 13.5%;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title"><h2>@{{ form_add_title }}</h2></div>
				<div class="form--top__btn">
					<a href="javascript:void(0);" class="btn__add__cancel" @click="resetForm">Cancel</a>
				</div>
			</div>
			<div class="form--mid">
				<div class="create__form content__tab active__content">
					<div class="form__group__row">
						<div class="create__form__row">
							<span class="form__group__title">Informasi Umum<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-1"><i>@include('schemars.svg-logo.ico-expand-arrow')</i></a>
							</span>
						</div>
						<div id="form-accordion-1">
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Nomer Induk KTP</label>
									<div class="field__icon">
										<input v-model="models.nik" name="nik" type="text" id="nik" class="form-control" placeholder="Isikan nomer induk ktp">
									</div>
									<div class="form--error--message" id="form--error--message--nik"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Nama Lengkap</label>
									<div class="field__icon">
										<input v-model="models.fullname" name="fullname" type="text" id="fullname" class="form-control" placeholder="Isikan nama lengkap dokter">
									</div>
									<div class="form--error--message" id="form--error--message--fullname"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Foto</label>
									<div class="upload__img" v-bind:class="{hide__element: foto_images}">
										<input name="foto_images" class="upload__img__input" type="file" id="foto_images" @change="onImageChange('foto_images', $event)">
										<label for="foto_images" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !foto_images}">
										<img class="upload__img__preview" :src="foto_images" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('foto_images')"></button>
									</div>


									<div class="form--error--message" id="form--error--message--foto_images"></div>
												<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg, jpeg. (With maximum width of {{ DOCTOR_FOTO_IMAGES_WIDTH }} x {{ DOCTOR_FOTO_IMAGES_HEIGHT }} px)</span>
									</div>
								</div>
								
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Jenis Kelamin</label>
									<select name="gender" class="form-control" v-model="models.gender">
										<option value="">Pilih Jenis Kelamin</option>
										<option value="male">Laki-laki</option>
										<option value="female">Perempuan</option>
									</select>
									<div class="form--error--message" id="form--error--message--gender"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Tempat Lahir</label>
									<div class="field__icon">
										<input v-model="models.place_of_birth" name="place_of_birth" type="text" id="place_of_birth" class="form-control" placeholder="Isikan tempat kelahiran">
									</div>
									<div class="form--error--message" id="form--error--message--place_of_birth"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Tanggal Lahir</label>
									<div class="content__input__wrapper__form">
										<div class="input-icon">
											<input v-model="models.date_of_birth" id="sotrdatepicker" name="date_of_birth" type="text" id="date_of_birth" class="form-control datepick" placeholder="Isikan tanggal lahir">
											<div class="icon__wrapper__form date-icon">
		                                        <i class="ico-date"></i>
		                                    </div>
										</div>
									</div>
									<div class="form--error--message" id="form--error--message--date_of_birth"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Agama</label>
									<select name="religion" class="form-control" v-model="models.religion">
										<option value="">Pilih Agama</option>
										<option value="1">ISLAM</option>
										<option value="2">KRISTEN KATOLIK</option>
										<option value="3">KRISTEN PROTESTAN</option>
										<option value="4">HINDU</option>
										<option value="5">BUDHA</option>
										<option value="6">LAINNYA</option>
									</select>
									<div class="form--error--message" id="form--error--message--religion"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Pendidikan</label>
									<select name="education" class="form-control" v-model="models.education">
										<option value="">Pilih Pendidikan Terakhir</option>
										<option value="1">D3</option>
										<option value="2">S1</option>
										<option value="3">S2</option>
										<option value="4">S3</option>
									</select>
									<div class="form--error--message" id="form--error--message--education"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Spesialis</label>
									<div class="field__icon">
										<input v-model="models.specialist" name="specialist" type="text" id="specialist" class="form-control" placeholder="Spesialis">
									</div>
									<div class="form--error--message" id="form--error--message--specialist"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Poliklinik</label>
									<select name="poliklinik_id" class="form-control" v-model="models.poliklinik_id">
										<option value="">Pilih Poliklinik</option>
										<option v-for="policlinic in responseData.policlinic" :value="policlinic.id">@{{ policlinic.policlinic_name }}</option>
									</select>
									<div class="form--error--message" id="form--error--message--poliklinik_id"></div>
								</div>
							</div>

						</div>

						<hr/>

						<div class="create__form__row">
							<span class="form__group__title">Informasi Tambahan<a href="javascript:void(0);" class="style__accordion" data-accordion="form-accordion-2"><i>@include('schemars.svg-logo.ico-expand-arrow')</i></a>
							</span>
						</div>

						<div id="form-accordion-2">
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Alamat</label>
									<div class="field__icon">
										<input v-model="models.street" name="street" type="text" id="street" class="form-control" placeholder="Isikan alamat pasien">
									</div>
									<div class="form--error--message" id="form--error--message--street"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Kecamatan</label>
									<div class="field__icon">
										<input v-model="models.districts" name="districts" type="text" id="districts" class="form-control" placeholder="Isikan kecamatan">
									</div>
									<div class="form--error--message" id="form--error--message--districts"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Kota</label>
									<div class="field__icon">
										<input v-model="models.city" name="city" type="text" id="city" class="form-control" placeholder="Isikan kota">
									</div>
									<div class="form--error--message" id="form--error--message--city"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Provinsi</label>
									<div class="field__icon">
										<input v-model="models.province" name="province" type="text" id="province" class="form-control" placeholder="Isikan provinsi">
									</div>
									<div class="form--error--message" id="form--error--message--province"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Warga Negara</label>
									<select name="citizen" class="form-control" v-model="models.citizen">
										<option value="">Warga Negara</option>
										<option value="1">WNI</option>
										<option value="2">WNA</option>
									</select>
									<div class="form--error--message" id="form--error--message--citizen"></div>
								</div>
							</div>

							<div class="create__form__row" v-if="models.citizen == '2'">
								<div class="new__form__field">
									<label>Negara</label>
									<div class="field__icon">
										<input v-model="models.country" name="country" type="text" id="country" class="form-control" placeholder="Isikan negara asal">
									</div>
									<div class="form--error--message" id="form--error--message--country"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Nomer Telepon</label>
									<div class="field__icon">
										<input v-model="models.phone_number" name="phone_number" type="text" id="phone_number" class="form-control" placeholder="Isikan nomer telepon">
									</div>
									<div class="form--error--message" id="form--error--message--phone_number"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Status Perkawinan</label>
									<select name="marital_status" class="form-control" v-model="models.marital_status">
										<option value="">Status Perkawinan</option>
										<option value="1">Belum Menikah</option>
										<option value="2">Sudah Menikah</option>
									</select>
									<div class="form--error--message" id="form--error--message--marital_status"></div>
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
							</div>
						</div>

						<div class="new__form__btn">
							<input v-if="edit == true" v-model="models.id" type="hidden" name="id">
							<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>
