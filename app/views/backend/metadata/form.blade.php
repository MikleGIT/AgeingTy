@if( $metadata )

	<?php $metafield_group_id = ''; ?>

	@foreach( $metadata->extractFormData() as $formdata )

		@if( $formdata['type'] == 'hidden:title' )
		<script>
		$('.title-container').hide(0);
		</script>
		@endif

		@if( $formdata['type'] == 'hidden:content' )
		<script>
		$('.content-container').hide(0);
		</script>
		@endif

		@if( $formdata['type'] == 'hidden:excerpt' )
		<script>
		$('.excerpt-container').hide(0);
		</script>
		@endif

		@if( $formdata['type'] == 'hidden:image' )
		<script>
		$('#image-container').hide(0);
		</script>
		@endif

		@if( $formdata['type'] == 'hidden:editor' )
		<script>
		$('#editor-container').hide(0);
		</script>
		@endif

		@if( $formdata['type'] == 'hidden:language-independent' )
		<script>
		$('#language-independent-container').hide(0);
		</script>
		@endif


		@if( $formdata['type'] == 'i18n-open' )

		<?php $metafield_group_id = rand(100000, 999999); ?>

		<div class="panel minimal minimal-gray" data-metafield-group-id="{{ $metafield_group_id }}" data-metafield-group="i18n">
			<ul class="nav nav-tabs">
				@foreach(Language::getAvailableLanguages() as $lang_index => $lang)
				<li{{ ($lang_index == 0) ? ' class="active"' : '' }} data-metafield-lang="{{ $lang->code }}">
					<a href="#__metafield_io_i18n_{{ $lang->code }}" data-toggle="tab">{{ $lang->name }}</a>
				</li>
				@endforeach
			</ul>
			
			<div class="panel-body">
				
				<div class="tab-content" style="margin-top: 10px">
		@endif


		@if( $formdata['type'] == 'text' || $formdata['type'] == 'textarea' )

			@if( $formdata['i18n'] )
				@foreach(Language::getAvailableLanguages() as $lang_index => $lang)
				<div data-metafield-lang="{{ $lang->code }}" data-metafield-group-id="{{ $metafield_group_id }}">
					<div class="row">
						<div class="col-sm-12">
							<label>{{ $formdata['title'] }}</label>

							@if( $formdata['type'] == 'text' )
							<input type="text" name="__metafield_io[{{ $metadata->meta_key }}][{{ $formdata['name'] }}__{{ $lang->code }}]" value="{{{ $metadata->getTextValue($formdata['name'] . '__' . $lang->code) }}}" class="form-control">
							@endif

							@if( $formdata['type'] == 'textarea' )
							<textarea name="__metafield_io[{{ $metadata->meta_key }}][{{ $formdata['name'] }}__{{ $lang->code }}]" class="form-control" style="height: 120px">{{{ $metadata->getTextValue($formdata['name'] . '__' . $lang->code) }}}</textarea>
							@endif

						</div>
					</div>

					<hr>
				</div>
				@endforeach
			@else
				<div class="row">
					<div class="col-sm-12">
						<label>{{ $formdata['title'] }}</label>

						@if( $formdata['type'] == 'text' )
						<input type="text" name="__metafield_io[{{ $metadata->meta_key }}][{{ $formdata['name'] }}]" value="{{{ $metadata->getTextValue($formdata['name']) }}}" class="form-control">
						@endif

						@if( $formdata['type'] == 'textarea' )
						<textarea name="__metafield_io[{{ $metadata->meta_key }}][{{ $formdata['name'] }}]" class="form-control">{{{ $metadata->getTextValue($formdata['name']) }}}</textarea>
						@endif

					</div>
				</div>

				<hr>
			@endif
		@endif

		@if( $formdata['type'] == 'image' )
			@if( $formdata['i18n'] )
				@foreach(Language::getAvailableLanguages() as $lang_index => $lang)
				<div data-metafield-lang="{{ $lang->code }}" data-metafield-group-id="{{ $metafield_group_id }}">
					<div class="row">
						<div class="col-sm-12">
							<label>{{ $formdata['title'] }}</label>

							@if( $metadata->getImageUrl($formdata['name'] . '__' . $lang->code) )
							<div>
								<img src="{{ asset($metadata->getImageUrl($formdata['name'] . '__' . $lang->code)) }}" class="img-thumbnail img-responsive">

								<label class="form-control">
									<input type="checkbox" value="1" name="__metafield_io[{{ $metadata->meta_key }}][{{ $formdata['name'] }}_remove__{{ $lang->code }}]">
									刪除圖片?
								</label>
							</div>
							@endif

							<input type="file" name="__metafield_io[{{ $metadata->meta_key }}][{{ $formdata['name'] }}__{{ $lang->code }}]" class="form-control">
						</div>
					</div>

					<hr>
				</div>
				@endforeach
			@else
			<div class="row">
				<div class="col-sm-12">
					<label>{{ $formdata['title'] }}</label>

					@if( $metadata->getImageUrl($formdata['name']) )
					<div>
						<img src="{{ $metadata->getImageUrl($formdata['name']) }}" class="img-thumbnail img-responsive">

						<label class="form-control">
							<input type="checkbox" value="1" name="__metafield_io[{{ $metadata->meta_key }}][{{ $formdata['name'] }}_remove]">
							刪除圖片?
						</label>
					</div>
					@endif

					<input type="file" name="__metafield_io[{{ $metadata->meta_key }}][{{ $formdata['name'] }}]" class="form-control">
				</div>
			</div>

			<hr>
			@endif
		@endif

		@if( $formdata['type'] == 'i18n-close' )
			<?php $metafield_group_id = ''; ?>
				</div>
			</div>
		</div>
		<!-- /.panel -->
		@endif


	@endforeach

@endif