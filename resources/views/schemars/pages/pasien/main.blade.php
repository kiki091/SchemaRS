
    <!-- page content -->
    <div id="app">
        
    	<div class="page-title">
		    <div class="row-header">
			        <div class="title_left">
			            <h3 class="filter__content">
					        {{ trans('general.title_lable_pasien') }}
				            <br/>
					        <small>
					            <strong class="filter__content">
					                
					            </strong>
					        </small>
				        </h3>
			    	</div>
			</div>
		</div>

        <div class="row">
	        <div class="col-md-12 col-sm-12 col-xs-12">

		        <div class="main__content__layer" style="margin-top: 5%;">
		        	<div class="content__top flex-between">
		        		<div class="content__title">
		        			<h2>@{{ form_add_title }}</h2>

		        		</div>
		        		<div class="content__btn">
		        			<a href="#" class="btn__add" id="toggle-form" @click="resetForm">Add Branch Office</a>
		        		</div>
		        	</div>
		        	<div class="content__bottom">
						<ul class="news__list sortable" id="sort">
							<li class="news__list__wrapper sort-item" v-for="patient in responseData.patient" data-id="@{{ patient.id }}">
								<div class="news__list__detail">
									<div class="drag__control">
										<div class="handle">
											@include('nusantara.cms.svg-logo.handle-drag')
										</div>
									</div>
									<div class="news__list__detail__left">
										<img src="{{ DEFAULT_USER_MALE }}" v-if="patient.gender == 'male'">

										<img src="{{ DEFAULT_USER_FEMALE }}" v-if="patient.gender == 'female'">
									</div>
									<div class="news__list__detail__middle-right">
										<div class="news__list__detail__middle">
											<div class="news__list__desc">
												<div class="news__name">
													<a href="#edit-data" class="title__name content__edit__hover" title="Edit Data">@{{ patient.fullname }}</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
		        </div>
	        </div>
        </div>
    </div>
    <!-- /page content -->