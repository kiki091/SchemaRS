<form action="{{ route('BranchOfficeEditFormTranslation') }}" method="POST" id="BranchOfficeEditFormTranslation" enctype="multipart/form-data" @submit.prevent>
	<div class="main__content__form__layer" id="toggle-form-edit-branch-office" style="display: none; margin-top: 5%;">
		<div class="create__form__wrapper">
			<div class="form--top flex-between">
				<div class="form__title">@{{ form_add_title }}</div>
				<div class="form--top__btn">
					<a href="#" class="btn__add__cancel">Cancel</a>
				</div>
			</div>
			<div class="form--mid">

				<div class="form__group__row">
					<div id="form-accordion">

						<div v-for="branch_office in models.branch_office">
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

							<div class="create__form__row">
								<a href="javascript:void(0);" v-if="$index != 0" class="btn__delete" @click="removeMoreOffice(branch_office, $index)">
									<i class="ico-delete">@include('nusantara.cms.svg-logo.ico-delete')</i>
								</a>
							</div>
							<hr/>
						</div>

						<div class="create__form__row" id="add-more-office">
							<a href="javascript:void(0);" class="add__link" @click="addMoreOffice">+ Add another office</a>
						</div>
					</div>
				</div>

			</div>
			<!-- END FORM WIZARD -->


			<div class="form--bot">
				<div class="create__form">
					<div class="create__form__row flex-end">
						<div class="new__form__btn">
							<input type="hidden" name="id" v-model="models.id" v-if="edit == true">
							{{ csrf_field() }}
							<button class="btn__form" type="submit" @click="postEditBranchOffice">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>