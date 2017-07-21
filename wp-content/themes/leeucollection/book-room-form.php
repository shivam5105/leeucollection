
		<div class="container booking-form-object">
			<div class="scroll-anim" data-anim="fade-up">
				<form action="https://gc.synxis.com/rez.aspx" method="get">
					<input type="hidden" name="locale" value="en-GB" />
					<input type="hidden" name="start" value="searchres" /><!-- Options: availresults, searchres -->
					<input type="hidden" name="arrive" value="" />
					<input type="hidden" name="nights" value="" />

					<div class="row booking-object-form-row">
						<div class="col-3 rm-pad">
							<div class="form-item select-item first-item">
								<select name="Hotel">
									<option>Select a hotel</option>
									<?php
									$args = array(
										'posts_per_page' => '-1',
										'orderby' => 'menu_order',
										'order' => 'ASC',
										'post_type' => 'hotel',
										'post_parent' => '0',
									);

									$hotel_post_array = get_posts($args);
									if(!empty($hotel_post_array))
									{
										foreach ($hotel_post_array as $key => $hotel_post)
										{
											$hotel_name 	= $hotel_post->post_title;
											$crb_hotel_id 	= carbon_get_post_meta($post->ID, "crb_hotel_id");
											?>
											<option value="<?php echo $crb_hotel_id; ?>"><?php echo $hotel_name; ?></option>
											<?php
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-3 rm-pad">
							<div class="form-item input-item"> 
								<input name="date" value="" placeholder="" required="required" type="text" class="rangePicker"> 
							</div>
						</div>
						<div class="col-2 rm-pad">
							<div class="form-item select-item">
								<select name="rooms">
									<?php
									for($i=2; $i<9; $i++)
									{
										?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?> room<?php if($i > 1){ echo "s"; }?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-2 rm-pad">
							<div class="form-item select-item">
								<select name="adult">
									<?php
									for($i=2; $i<9; $i++)
									{
										?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?> guest<?php if($i > 1){ echo "s"; }?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-2 rm-pad">
							<div class="form-item">
								<button type="submit" class="submit-btn ucase">CHECK AVAILABILITY</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>