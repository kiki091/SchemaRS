
    <!-- page content -->
    <div id="app">
    
		@include('schemars.pages.doctor.partials.form')
		
        <div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12">
	        	
				@include('schemars.pages.doctor.partials.folder')
				
		        <div class="main__content__layer" style="margin-top: 3%;">
					
					<div class="content__top flex-between">
						<div class="content__form">

							<div class="content__form__row">
								<label>NIK</label>
							
								<div class="content__input__wrapper">
									<div class="input-icon">
										<input type="text" class="field__search__function" id="filter-function-nik" placeholder="Cari berdasarkan nik" @keyup="searchDataByNik">
									</div>
								</div>
							</div>


							<div class="content__form__row">
								<label>Poliklinik</label>
							
								<div class="content__input__wrapper">
									<div class="input-icon">
										<input type="text" class="field__search__function" id="filter-function-poliklinik" placeholder="Cari berdasarkan poliklinik" @keyup="searchDataByPoliName">
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
								<th>NIK</th>
								<th>Nama Lengkap</th>
								<th>Spesialis</th>
								<th>Poliklinik</th>
								<th>Status</th>
							</tr>
							<!-- isi tabel -->
							<!--v-for-start-->
							<tr v-for="doctor in responseData.doctor">
								<td>@{{ $index + 1 }}</td>
								<td>
									<a href="#edit-data" class="title__name content__edit__hover" title="Edit Data" @click="editData(doctor.id)">
										@{{ doctor.nik }}
									</a>
								</td>
								<td>@{{ doctor.fullname }}</td>
								<td>@{{ doctor.specialist }}</td>
								<td>@{{ doctor.policlinic }}</td>
								<td>
									<label class="switch">
										<input class="switch-input" id="check_1" type="checkbox" :checked="doctor.is_active == true" @change="changeStatus(doctor.id)"/>
                                    	<span class="switch-label" data-on="Active" data-off="Inactive"></span> <span class="switch-handle"></span>
									</label>
								</td>
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