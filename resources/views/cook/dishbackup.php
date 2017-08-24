 Dish</button>

    <table>
       <div class="row">
       <tr><div class="col-xs-18 col-sm-6 col-md-3">
          <!--  -->
          
             @foreach($dishes as $dish)
           <td>
            <!--  <div class="thumbnail"> -->
                      <img src="{{asset('img/shrimpandbroccolipenne.jpg')}}" alt="">
                 <div class="caption">
                      <h5><a href="{{url('cook/dishes/'.$dish['id'])}}"  data-toggle="modal" data-target="#modal-default">{{$dish['dish_name']}}</a></h5>
                           <label>Price: </label>
                           <p>Php {{$dish['dish_price']}}</p>
                               <p>{{$dish['dish_desc']}}</p>
                                 <button type="button" class="btn btn-flat btn-primary edit" value="{{$dish['id']}}"><i class="fa fa-edit">
                                 </i></button>
                                   <button type="button" class="btn btn-flat btn-danger"><i class="fa fa-times"></i></button>
                        </div>
                  </div>
                  </td>
                  @endforeach
            
          </tr>
        </div>
          </table>

</div>
</div>
       
