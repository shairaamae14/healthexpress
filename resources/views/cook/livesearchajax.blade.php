<?php
if(!empty($ingreds))  
{ 
    $count = 1;
    $outputhead = '';
    $outputbody = '';  
    $outputtail ='';

    $outputhead .= '<div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                  
    foreach ($ingreds as $ing)    
    {   
    // $body = substr(strip_tags($ing->body),0,50)."...";
    // $show = url('blog/'.$ing->slug);
    $outputbody .=  ' 
                
                            <tr> 
                                <td>'.$ing->name.'</td>
                                <td><a onclick="adding()" target="_blank" title="ADD" ><span class="glyphicon glyphicon-list">+</span></a></td>
                            </tr> 
                    ';
                
    }  

    $outputtail .= ' 
                        </tbody>
                    </table>
                </div>';
         
    echo $outputhead; 
    echo $outputbody; 
    echo $outputtail; 
 }  
 
 else  
 {  
    echo 'Data Not Found';  
 } 
 ?>  