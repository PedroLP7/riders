@if(Session::has('mensaje'))



<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{Session::get('mensaje')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif




@if (Session::has('error'))


<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{Session::get('error')}}
</div>


@endif

<style>
  .alert {
    border-radius: 0;
    display: flex;
    position: absolute;
    width: 100%;
    height: 3%;
    margin: 0;
    top: 0;
    left: 0;
    background: #E46962;
    border: none;
    align-items: center;
    justify-content: center;
    color: #1E1E1E;
    font-weight: 500;
  }

  .alert-dismissible {
    padding-right: 0;
}
</style>
