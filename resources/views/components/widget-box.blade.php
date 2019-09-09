<div class="widget-box widget-color-blue3" id="{{$id or null}}">
		<div class="widget-header">
			<h5 class="widget-title">{{$title}}</h5>
		
			<div class="widget-toolbar ">
		     {{$toolbar or null}}
			</div>
		</div>

		<div class="widget-body">
			@isset($foo)
           <form class="form-horizontal" id="{{$formId}}" role="form" novalidate="novalidate" >
            @endisset
				<div class="widget-main">
				{{$body}}
				</div>
            
			<div class="widget-toolbox padding-8 clearfix">
			{{$footer}}
			</div>
			@isset($foo)
            </form >
            @endisset
		</div>
</div> 