<div id="sales_chart" class=" container mb-8 text-black p-4 bg-beige rounded-lg">
   <div class="hidden">
      {!! $chart->container() !!}
   </div>
</div>

<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
