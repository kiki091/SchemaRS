<form action="{{ route('StoreBranchOffice') }}" method="POST" id="BranchOfficeForm" enctype="multipart/form-data" files="true" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-content" style="display: none; margin-top: 5%;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title"><h2>@{{ form_add_title }}</h2></div>
				<div class="form--top__btn">
					<a href="#" class="btn__add__cancel" @click="resetForm">Cancel</a>
				</div>
			</div>
			<div class="form--mid">
				<div class="create__form content__tab active__content">
					<div class="form__group__row">
						<div id="form-accordion">
							<div class="create__form__row">
								<span class="form__group__title">General Information</span>
							</div>
							<div class="create__form__row">
								<div class="new__form__field">
									<label>Office Title</label>
									<div class="field__icon">
										<input v-model="models.title" name="title" type="text" id="title" class="form-control" placeholder="Enter the title here">
									</div>
									<div class="form--error--message" id="form--error--message--title"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Office Name</label>
									<div class="field__icon">
										<input v-model="models.office_name" name="office_name" type="text" id="office_name" class="form-control" placeholder="Enter the site title here">
									</div>
									<div class="form--error--message" id="form--error--message--office_name"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field">
									<label>Slug</label>
									<div class="field__icon">
										<input v-model="models.title | lowercase | strSlug" name="slug" type="text" id="slug" class="form-control" placeholder="Enter the slug name here" readonly>
									</div>
									<div class="form--error--message" id="form--error--message--slug"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field upload__image">
									<label>Thumbnail</label>
									<div class="upload__img" v-bind:class="{hide__element: thumbnail}">
										<input name="thumbnail" class="upload__img__input" type="file" id="thumbnail" @change="onImageChange('thumbnail', $event)">
										<label for="thumbnail" class="upload__img__label"></label>
									</div>
									<div class="upload__img" v-bind:class="{hide__element: !thumbnail}">
										<img class="upload__img__preview" :src="thumbnail" />
										<input type="text" v-model="image" hidden="hidden" />
										<button class="upload__img__remove" @click="removeImage('thumbnail')"></button>
									</div>


									<div class="form--error--message" id="form--error--message--thumbnail"></div>
												<!-- upload tip -->
									<div class="upload__tip">
										<span><b>Upload Tip: </b>Please upload high resolution photo only with format of *jpg, jpeg. (With maximum width of {{ BRANCH_OFFICE_THUMBNAIL_WIDTH }} x {{ BRANCH_OFFICE_THUMBNAIL_HEIGHT }} px)</span>
									</div>
								</div>
								
							</div>
							
							<div class="create__form__row" v-if="edit == false">
								<div class="new__form__field width-auto">
									<label>Slider Image</label>
									<div class="form__photo__uploader single__image">
										<small>Drop <span><b>Main image</b></span> in this area. Sort images by "draging and droping" in the desired position</small>

										<div class="form__photo__uploader__wrapper flex flex-align-center">
											<ul class="form__photo__uploader__ul photo-sortable" >
												<li class="form__photo__uploader__li" v-for="detailImage in default_total_detail_image">
													<div class="form__photo__handle handle">
														@include('nusantara.cms.svg-logo.handle-drag')
													</div>

													<div class="form__photo__group">
														<div class="form__photo__left">
															<div class="upload__img" v-bind:class="{hide__element: images[$index]}">
																<input name="images[@{{ $index }}]" class="upload__img__input" type="file" id="images_@{{$index }}" @change="onImageSliderChange('images', $index, $event)">
																<label for="images_@{{$index }}" class="upload__img__label"></label>
															</div>
															<div class="upload__img" v-bind:class="{hide__element: !images[$index]}">
																<img class="upload__img__preview" :src="images[$index]" />
																<a href="javascript:void(0);" class="upload__img__show__preview" id="img-preview" @click="previewImage(images[$index])">&times;</a>
																<button class="upload__img__remove" @click="removeImageSlider('images', $index)" v-if="edit == false">&times;</button>
															</div>
															<span class="form__photo__title">Desktop</span>
														</div>
													</div>
													<a href="javascript:void(0);" class="form__photo__remove" v-if="$index != 0" @click="removeImageWrapper(detailImage, $index)">&times;</a>
												</li>
											</ul>
											<!-- POPUP UPLOAD PREVIEW LARGE -->
											<a href="javascript:void(0);" class="form__photo__placeholder" id="add-card-photo-uploader-en" @click="addMoreImageSlider()" v-if="default_total_detail_image.length != 4"><i>&plus;</i><span>Add New</span></a>
										</div>
										<div class="image__upload__preview__wrapper">
											<div class="img__preview__overlay" id="img-preview-popup">
												<div class="img__preview__popup">
													<div class="img__preview__popup__wrapper">
														<a href="javascript:void(0);" class="img__preview__big__close">&times;</a>
														<img class="upload__img__preview__big" :src="image_big_preview" />
													</div>
												</div>
											</div>
										</div>
										<small>
											<span>Upload Tip: </span>
											Please upload high resolution photo only with format of *jpeg. 
											<br />
											(<b>Desktop</b> With Dimension: {{ BRANCH_OFFICE_IMAGES_WIDTH }} x {{ BRANCH_OFFICE_IMAGES_HEIGHT }} pixels)
										</small>
									</div>
								</div>
							</div>
							
							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Side Description</label>
									<div class="field__icon">
										<textarea v-model="models.side_description" name="side_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--side_description"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Description</label>
									<label class="cms__insert__template" @click="importTemplate('template-description')">Import Template</label>
									<div class="field__icon">
										<textarea v-model="models.description" class="ckeditor" id="editor-1" name="description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--description"></div>
								</div>
							</div>

							<div class="create__form__row">
								<div class="new__form__field width-auto">
									<label>Address</label>
									<div class="field__icon">
										<textarea v-model="models.address" name="address" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--address"></div>
								</div>
							</div>
						</div>
					</div>

					<hr/>

					<div class="form__group__row">
						<div id="form-accordion">
							<div class="create__form__row">
								<span class="form__group__title">Branch Office</span>
							</div>
							<div v-for="branch_office in models.branch_office">

								<div class="create__form__row" v-if="edit == true && branch_office.office_id != NULL" style="float: right;">
									<a href="javascript:void(0);" class="btn__delete" @click="removeBranchOfficeDataFromServer(branch_office.office_id, $index, branch_office)" title="Delete data">
										<i class="ico-delete">@include('nusantara.cms.svg-logo.ico-delete')</i>
									</a>
								</div>
								<div class="create__form__row">
									<div class="new__form__field">
										<label>Office Title</label>
										<div class="field__icon">
											<input :value="branch_office.title_description" name="branch_office[@{{ $index }}][title_description]" type="text" class="form-control" placeholder="Enter the title description here">
										</div>
										<div class="form--error--message" id="form--error--message--branch_office[@{{ $index }}][title_description]"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field width-auto">
										<label>Address</label>
										<div class="field__icon">
											<textarea :value="branch_office.address" name="branch_office[@{{ $index }}][address]" style="margin: 0px; width: 500px; height: 125px;"></textarea>
										</div>
										<div class="form--error--message" id="form--error--message--address"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Latitude</label>
										<div class="field__icon">
											<input :value="branch_office.latitude" name="branch_office[@{{ $index }}][latitude]" type="text" class="form-control" placeholder="Enter the latitude here">
										</div>
										<div class="form--error--message" id="form--error--message--branch_office[@{{ $index }}][latitude]"></div>
									</div>
								</div>

								<div class="create__form__row">
									<div class="new__form__field">
										<label>Longitude</label>
										<div class="field__icon">
											<input :value="branch_office.longitude" name="branch_office[@{{ $index }}][longitude]" type="text" class="form-control" placeholder="Enter the longitude here">
										</div>
										<div class="form--error--message" id="form--error--message--branch_office[@{{ $index }}][longitude]"></div>
									</div>
								</div>

								<div class="create__form__row" v-if="edit == false">
									<a href="javascript:void(0);" v-if="$index != 0" class="btn__delete" @click="removeMoreOffice(branch_office, $index)">
										<i class="ico-delete">@include('nusantara.cms.svg-logo.ico-delete')</i>
									</a>
								</div>

								
								<hr/>
							</div>
							<div class="create__form__row" id="add-more-office">
								<a href="javascript:void(0);" class="add__link" @click="addMoreOffice" v-if="default_total_office.length + total_office.length != 4">+ Add another office</a>
							</div>
						</div>
					</div>

					<hr/>

					<div class="form__group__row">
						<div id="form-accordion">
							<div class="create__form__row">
								<span class="form__group__title">Seo</span>
							</div>
							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Meta Title</label>
									<div class="field__icon">
										<input v-model="models.meta_title" name="meta_title" type="text" id="meta_title" class="form-control" placeholder="Enter the site name here">
									</div>
									<div class="form--error--message" id="form--error--message--meta_title"></div>
								</div>
							</div>

							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Meta Description</label>
									<div class="field__icon">
										<textarea v-model="models.meta_description" name="meta_description" style="margin: 0px; width: 500px; height: 125px;"></textarea>
									</div>
									<div class="form--error--message" id="form--error--message--meta_description"></div>
								</div>
							</div>

							<div class="create__form__row form--media">
								<div class="new__form__field" style="width: 500px;">
									<label>Meta Keyword</label>
									<div class="field__icon">
										<input v-model="models.meta_keyword" name="meta_keyword" type="text" id="meta_keyword" class="form-control" placeholder="Enter the site name here">
									</div>
									<div class="form--error--message" id="form--error--message--meta_keyword"></div>
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
							<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
							<input v-model="models.id" type="hidden" name="id">
							<button class="btn__form" type="submit" @click="storeData">Save</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>

<div style="display: none" id="template-description">
	@include('nusantara.cms.content-template.pages.branch-office.description')
</div>