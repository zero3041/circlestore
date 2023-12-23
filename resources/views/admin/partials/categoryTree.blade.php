<ul id="treeview">
  <li> <i class="fa fa-plus"></i>
    <label>
      <input type="checkbox" name="category[]" value="0_1" disabled="" />
      Gốc </label>
    <ul>
      @isset($category)
          
      
      @foreach ($category['level1'] as $value1) 
       <li> <i class="fa fa-plus"></i>
          <label>
            <input type="checkbox" name="category[]" value="{{$value1['id_category']}}_1" @isset($category_product) @if(in_array($value1['id_category'], $category_product)) checked="" @endif @endisset />
            {{$value1['name']}} </label>

          @foreach ($category['level2'] as $value2)
          @if($value2['id_parent']==$value1['id_category'])
          <ul>
            <li> <i class="fa fa-plus"></i>
              <label>
            <input type="checkbox" name="category[]" value="{{$value2['id_category']}}_2" @isset($category_product) @if(in_array($value2['id_category'], $category_product)) checked="" @endif @endisset/>
            {{$value2['name']}} </label>

             @foreach ($category['level3'] as $value3)
              @if($value3['id_parent']==$value2['id_category'])       
             <ul>
              <li> <i class="fa fa-plus"></i>
              <label>
                <input type="checkbox" name="category[]" value="{{$value3['id_category']}}_3" @isset($category_product) @if(in_array($value3['id_category'], $category_product)) checked="" @endif @endisset/>
                {{$value3['name']}} </label>
             @foreach ($category['level4'] as $value4)
             @if($value3['id_parent']==$value2['id_category'])
             <ul>
              <li>
              <label><i class="fa fa-plus"></i> {{$value4['name']}} 
              </li>
            </ul>
            @endif
             @endforeach
            </li>
            </ul>
            @endif
            @endforeach

            </li>
          </ul>
          @endif
          @endforeach

        </li>
      
      @endforeach
     @endisset
    </ul>
  </li>
</ul>