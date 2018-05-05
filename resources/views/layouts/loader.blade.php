@section('head')

<style>
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('/dist/img/loader.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
@endsection

@section('loader')
<div class="loader"></div>
@endsection

@section('scripts')
<!--loader-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!--loader-->
<script type="text/javascript">
	$(window).load(function() {
       $(".loader").fadeOut("slow");
   });
</script>
@endsection
