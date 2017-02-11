function msg(msg,type){ var r_msg = '';
    if(msg != null && type!=''){
        r_msg += '<div class="alert alert-'+type+' alert-dismissible">';
        r_msg += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        r_msg += '<div><i class="icon fa fa-check"></i><span>'+msg+'</span></div></div>';        
    } return r_msg;
}