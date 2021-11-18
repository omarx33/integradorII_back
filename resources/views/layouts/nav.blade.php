<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="navbar-toggler-icon"></span>
				</button> <a class="navbar-brand" href="#">CHATBOT</a>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">





                    <ul class="navbar-nav">

@guest

      @else

       @include('layouts.menu'){{-- si esta logueado --}}

@endguest

					</ul>



     {{-- fin --}}


					<ul class="navbar-nav ml-md-auto">


@guest


@if (Route::has('login'))
<li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
</li>
@endif

@if (Route::has('register'))
<li class="nav-item">
    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
</li>
@endif

@else
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown"> {{ Auth::user()->nombre }} </a>
   <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">


       <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
       @csrf
   </form>
   </div>
</li>

@endguest





					</ul>






				</div>
			</nav>

		</div>
	</div>

</div>
