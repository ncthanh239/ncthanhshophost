    @extends('layouts.masterstore')
    @section('noidung')

    <div class="products-gallery">
       <div class="container">
           <div class="col-md-9 grid-gallery">
            @if(isset($data))
            @foreach($data as $product)
            @if(isset($product['images']) && count($product['images']) > 0)
            

            <div class="col-md-4 grid-stn simpleCart_shelfItem">
                <!-- normal -->
                <div class="ih-item square effect3 bottom_to_top">
                    <div class="bottom-2-top">
                        <div class="img"><img src="{{ asset(\Storage::url($product['images'][0])) }}" alt="/" class="img-responsive gri-wid"></div>
                        <div class="info">
                            <div class="pull-left styl-hdn">
                                <h3>{{$product['name']}}</h3>
                            </div>
                            <div class="pull-right styl-price">
                                <p><a  href="#" class="item_add"><span class="glyphicon glyphicon-shopping-cart grid-cart" aria-hidden="true"></span> <span class=" item_price">{{$product['price']}} $</span></a></p>
                            </div>
                            <div class="clearfix"></div>
                        </div></div>
                    </div>
                    <!-- end normal -->
                    <div class="quick-view">
                        <a href="{{asset('')}}detail/{{$product['product_id']}}">Quick view</a>
                    </div>
                </div>
                @endif
                @endforeach
                @endif
                {{ $products->links() }}
                









                <div class="clearfix"></div>
            </div>
            <div class="col-md-3 grid-details">
                <div class="grid-addon">
                    <section  class="sky-form">
                      <div class="product_right">
                       <h4 class="m_2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Categories</h4>
                       <div class="tab1">
                        @if(@isset ($categories))
                        @foreach ($categories as $category)
                        <ul class="place">                              
                         <li class="sort">{{$category->name}}</li>
                         <li class="by"><img src="images/do.png" alt=""></li>
                         <div class="clearfix"> </div>
                     </ul>
                     @if(!empty($category->subcategories))
                     <div class="single-bottom"> 
                         @foreach ($category->subcategories as $sub)                     
                         <a href="{{ asset('') }}store/{{$sub->slug}}"><p>{{$sub->name}}</p></a>
                         @endforeach
                     </div>
                     @endif
                     @endforeach

                     @endif
                 </div>                         


                 <!--script-->
                 <script>
                   $(document).ready(function(){
                    $(".tab1 .single-bottom").hide();

                    $(".tab1 ul").click(function(){
                     $(".tab1 .single-bottom").slideToggle(300);
                    
                 })
                    
                    
                     
                    
                });
            </script>
            <!-- script -->                  
        </section>
        <section  class="sky-form">
          <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>DISCOUNTS</h4>
          <div class="row row1 scroll-pane">
           <div class="col col-4">
            <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Upto - 10% (20)</label>
        </div>
        <div class="col col-4">
            <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>40% - 50% (5)</label>
            <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>30% - 20% (7)</label>
            <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>10% - 5% (2)</label>
            <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Other(50)</label>
        </div>
    </div>
</section>               
<!---->
{{-- <link rel="stylesheet" type="text/css" href="css/jquery-ui.css"> --}}
                                    {{-- <script>//<![CDATA[ 
                                    $(window).load(function(){
                                      $( "#slider-range" ).slider({
                                        range: true,
                                        min: 0,
                                        max: 400000,
                                        values: [ 2500, 350000 ],
                                        slide: function( event, ui ) {  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                                    }
                                });
                                      $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );

                                    });//]]>  

                                </script> --}}
                                <section  class="sky-form">
                                  <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Type</h4>
                                  <div class="row row1 scroll-pane">
                                    <div class="col col-4">
                                        <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Air Max (30)</label>
                                    </div>
                                    <div class="col col-4">
                                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Armagadon   (30)</label>
                                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Helium (30)</label>
                                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Kyron     (30)</label>
                                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Napolean  (30)</label>
                                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Foot Rock   (30)</label>
                                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Radiated  (30)</label>
                                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Spiked  (30)</label>
                                    </div>
                                </div>
                            </section>
                            <section  class="sky-form">
                              <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Brand</h4>
                              <div class="row row1 scroll-pane">
                                <div class="col col-4">
                                 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Roadstar</label>
                             </div>
                             <div class="col col-4">
                                 <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Tornado</label>
                                 <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Kissan</label>
                                 <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Oakley</label>
                                 <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Manga</label>
                                 <label class="checkbox"><input type="checkbox" name="checkbox" ><i></i>Wega</label>
                                 <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Kings</label>
                                 <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Zumba</label>
                             </div>
                         </div>
                     </section>       
                 </div>
             </div>
             <div class="clearfix"></div>
         </div> 
     </div>
     @endsection