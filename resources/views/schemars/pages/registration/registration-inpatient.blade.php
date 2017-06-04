
    <!-- page content -->
    <div id="app">
        <!-- 
    	<div class="page-title">
		    <div class="row-header">
		        <div class="title_left">
		            <h3 class="filter__content">
				        REGISTRASI PASIEN
			            <br/>
				        <small>
				            <strong class="filter__content">
				                
				            </strong>
				        </small>
			        </h3>
		    	</div>
			</div>
		</div> -->
		
		@include('schemars.pages.registration.partials.form-inpatient')
		{{--
		@include('schemars.pages.registration.partials.table-inpatient')
		--}}
        <div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12">
	        	<div class="folder--nav">
					@include('schemars.pages.registration.partials.folder')
				</div>
		        <div class="main__content__layer" style="margin-top: 3%;">
					
					<div class="content__top flex-between">
						<div class="content__form">
							<div class="content__form__row">
								<label>NOMER REGISTRASI</label>
							
								<div class="content__input__wrapper">
									<div class="input-icon">
										<input type="text" class="field__search__function" id="filter-function-by-number" placeholder="Cari berdasarkan nomer" @keyup="searchDataByNumber">
									</div>
								</div>
							</div>

							<div class="content__form__row">
								<label>NIK</label>
							
								<div class="content__input__wrapper">
									<div class="input-icon">
										<input type="text" class="field__search__function" id="filter-function" placeholder="Cari berdasarkan nik" @keyup="searchDataByNik">
									</div>
								</div>
							</div>

							<div class="content__form__row">
								<label>Tanggal Registrasi</label>
							
								<div class="content__input__wrapper">
									<div class="input-icon">
										<input type="text" placeholder="Cari berdasarkan tanggal registrasi" class="datepick">
										<div class="icon__wrapper date-icon">
	                                        <i class="ico-date"></i>
	                                    </div>
									</div>
								</div>
							</div>
						</div>
						<div class="content__btn">
		        			<a href="javascript:void(0);" class="btn__add" id="toggle-form" @click="resetForm">+</a>
		        		</div>
					</div>

					<div class="content__bottom">
						<table align="center" cellpadding="0" cellspacing="0" class="table__style">
						<tbody>
							<!-- header tabel -->
							<tr>
								<th>No</th>
								<th>Nomer Registrasi</th>
								<th>NIK</th>
								<th>Nama Lengkap</th>
								<th>Tanggal Registrasi</th>
								<th>Dokter</th>
								<th>Ruangan</th>
								<th>Kelas</th>
								<th>Opsi</th>
							</tr>
							<!-- isi tabel -->
							<!--v-for-start-->
							<tr v-for="registration_inpatient in responseData.registration_inpatient">
								<td>@{{ $index + 1 }}</td>
								<td>@{{ registration_inpatient.registration_number }}</td>
								<td>@{{ registration_inpatient.nik }}</td>
								<td>@{{ registration_inpatient.fullname }}</td>
								<td>@{{ registration_inpatient.registration_date }}</td>
								<td>@{{ registration_inpatient.doctor }}</td>
								<td>@{{ registration_inpatient.room_care }}</td>
								<td>@{{ registration_inpatient.room_class }}</td>
							</tr><!--v-for-end-->
							<!-- end isi tabel -->
						</tbody>
					</table>
					</div>
		        </div>
	        </div>
        </div>
    </div>
    <!-- /page content -->