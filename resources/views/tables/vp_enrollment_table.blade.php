<div id="GenderProgram" class="tago row" style="display:none">

	<div class="col-md-12 col-sm-12  col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Chart</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Settings 1</a>
								</li>
								<li><a href="#">Settings 2</a>
								</li>
							</ul>
						</li>
											<li><a class="close-link"><i class="fa fa-close"></i></a>
											</li>
					</ul>
										<div class="clearfix"></div>
			</div>
			<div class="x_content">

				<div id="programgender" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>List of Enrollee</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<a href="{{route('vp_enrol_pdf')}}" target="_blank" class="dropdown-toggle" aria-expanded="false"><i class="fa fa-print"></i></a>					
					</li>
						<li>
							<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
										 
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<p id="headertable" class="text-muted font-13 m-b-30 ">
					<b><h2><center>Enrollment in the Branches by Program and Gender</center></h2></b>
				</p>
				<table id="datatable-buttons" class="table table table-bordered" style="margin: 0px 2px 0px 2px; width: 99%;border:1px solid black;table-layout:fixed;">
					<col style="width: 35%;"/>
					<thead>
						<tr>
								<th rowspan="3" style="width: 35%; border:1px solid black;"><center><h3>PROGRAMS</h3> </center></th>
								<th colspan="6" style="width: 40%; border:1px solid black;"><center>GENDER </center></th>
						</tr>
						<tr>
								<th colspan="2" style="width: 21%; border:1px solid black;"><center>MALE</center></th>
								<th colspan="2" style="width: 21%; border:1px solid black;"><center>FEMALE</center></th>
								<th  colspan="2" style="width: 21%; border:1px solid black;"><center>TOTAL</center></th>
						</tr>
						<tr>
								<th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
								<th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
								<th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
								<th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
								<th style="width: 10.5%; border:1px solid black;"><center>No.</center></th>
								<th style="width: 10.5%; border:1px solid black;"><center>%</center></th>
																				
						</tr>
						<tr>
						<th colspan="7" style="width: 10.5%; border:1px solid black;   color:black;  font-weight: bold; background-color: #ffc000;">HIGHER EDUCATION</th>             
						</tr>
					</thead>

					<tbody>
						@foreach($t_loc as $key =>$tl)
						<tr>
							@if ($tl->education == "Higher Education"  )
								<th colspan="7" style="width: 40%; border:1px solid black; padding-left:2.5%; font-weight: bold; color:black;">
									{{$tl->Address}}
								</th>
						</tr>

								@foreach($t_univ as $key =>$sp)
									@if ($sp->Address == $tl->Address && $sp->education == "Higher Education" )

										<tr>
											<td  style="width: 40%; border:1px solid black; padding-left:5%;color:black;">{{ $sp->course ."-". $sp->major}}</td>   
											<td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->Male}}</td>  
											<td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->malepercent}}</td>  
											<td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->Female}}</td>  
											<td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->femalepercent}}</td>  
											<td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->total}}</td>  
											<td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->totalpercent}}</td>              
										</tr>
									@endif
								@endforeach

								@foreach($t_total as $key =>$tt)
									@if ($tl->Address == $tt->Address && $tt->education == "Higher Education")

										<tr>
											<td  style="width: 40%; border:1px solid black; padding-left:42%; color:black;  font-weight: bold; background-color:#bfbfbf;">
												Total
											</td>
											<td  style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">
												{{ $tt->Male}}
											</td>   
											<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">
												{{ $tt->malepercent}}
											</td>  
					 						<td  style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">
					 							{{ $tt->Female}}
					 						</td>   
					 						<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">
					 							{{ $tt->femalepercent}}
					 						</td>   
					 						<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">
					 							{{ $tt->total}}
					 						</td>   
					 						<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">
					 							{{ $tt->totalpercent}}
					 						</td>            
										</tr>
									@endif
								@endforeach
							@endif


						@endforeach


						@foreach($t_educ as $key =>$te)

						@if ($te->education == "Higher Education" )

							<tr>
					
								<td style="width: 40%; border:1px solid black; padding-left:13%;  font-weight: bold; color:black; background-color:#ffff00; ">
									Sub Total, Higher Education
								</td>   
								<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">
									{{ $te->Male}}
								</td>  
								<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">
									{{ $te->malepercent}}
								</td>  
								<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">
									{{ $te->Female}}</td>  
								<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">
									{{ $te->femalepercent}}
								</td>  
								<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">
									{{ $te->total}}
								</td>  
								<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">
									{{ $te->totalpercent}}
								</td>              
							</tr>
						@endif
						@endforeach
					</tbody>

					<tr>
						<th colspan="7" style="width: 10.5%; border:1px solid black;   color:black;  font-weight: bold; background-color: #ffc000;">TECHNICAL PROGRAMS</th>             
					</tr>
 
					<tbody>
						@foreach($t_loc as $key =>$tl)
								<tr>
									@if ($tl->education == "Technical Program"  )
								<th colspan="7" style="width: 40%; border:1px solid black; padding-left:2.5%; font-weight: bold; color:black;">
									{{$tl->Address}}
								</th>
								</tr>

								@foreach($t_univ as $key =>$sp)
									@if ($sp->Address == $tl->Address && $sp->education == "Technical Program" )
										<tr>
										<td  style="width: 40%; border:1px solid black; padding-left:5%; color:black;">{{ $sp->course ."-". $sp->major}}</td>   
											<td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->Male}}</td>  
											<td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->malepercent}}</td>  
											<td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->Female}}</td>  
											<td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->femalepercent}}</td>  
											<td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->total}}</td>  
											<td  style="width: 40%; border:1px solid black;color:black;">{{ $sp->totalpercent}}</td>              
										</tr>
									@endif
								@endforeach
								@foreach($t_total as $key =>$tt)
									@if ($tl->Address == $tt->Address && $tt->education == "Technical Program")
 										<tr>
											<td  style="width: 40%; border:1px solid black; padding-left:42%; color:black;  font-weight: bold; background-color:#bfbfbf;">Total</td>
											<td  style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">{{ $tt->Male}}</td>   
											<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">{{ $tt->malepercent}}</td>  
					 						<td  style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">{{ $tt->Female}}</td>   
					 						<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">{{ $tt->femalepercent}}</td>   
					 						<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">{{ $tt->total}}</td>   
					 						<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">{{ $tt->totalpercent}}</td>            
										</tr>
									@endif
								@endforeach
							@endif
						@endforeach



						@foreach($t_educ as $key =>$te)
							@if ($te->education == "Technical Program" )

								<tr>
									<td style="width: 40%; border:1px solid black; padding-left:13%;  font-weight: bold; color:black; background-color:#ffff00;">Sub Total, Technical Programs</td>   
									<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->Male}}</td>  
									<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->malepercent}}</td>  
									<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->Female}}</td>  
									<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->femalepercent}}</td>  
									<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->total}}</td>  
									<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">{{ $te->totalpercent}}</td>                        
								</tr>
							@endif
						@endforeach
		
						@foreach($t_grand_total as $key =>$tgt)


						<tr>
							<td style="width: 40%; border:1px solid black; padding-left:18%;  font-weight: bold; color:black; background-color:#00b0f0;">GRAND TOTAL</td>   
							<td  style="width: 40%; border:1px solid black;color:black; background-color:#00b0f0;">{{ $tgt->Male}}</td>  
							<td  style="width: 40%; border:1px solid black;color:black; background-color:#00b0f0;">{{ $tgt->malepercent}}</td>  
							<td  style="width: 40%; border:1px solid black;color:black; background-color:#00b0f0;">{{ $tgt->Female}}</td>  
							<td  style="width: 40%; border:1px solid black;color:black; background-color:#00b0f0;">{{ $tgt->femalepercent}}</td>  
							<td  style="width: 40%; border:1px solid black;color:black; background-color:#00b0f0;">{{ $tgt->total}}</td>  
							<td  style="width: 40%; border:1px solid black;color:black; background-color:#00b0f0;">{{ $tgt->totalpercent}}</td>                        
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

		</div>
	</div> <!--naaaa-->
</div>


