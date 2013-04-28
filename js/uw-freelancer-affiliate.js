function uw_freelancer_affiliate(json) {   
    // let's check if received at least 1 project
    if (json.projects.count>0) {
        
        json.projects.items.forEach(function(p){ 
        
        // format budget
        var budget = ((p.budget.min!='' && p.budget.max!='')?'$'+p.budget.min+' - $'+p.budget.max:'')+
                ((p.budget.min!='' && p.budget.max=='')?'from $'+p.budget.min:'')+
                ((p.budget.min=='' && p.budget.max!='')?'up to $'+p.budget.max:'');                

        // format project name
        var projectTitle = p.name + 
                (p.options.featured?' <i style="color:#ccc; font-size:75%;">Featured Project</i>':'')+
                (p.options.trial?' <i style="color:#ccc; font-size:75%;">Trial Project</i>':'')+
                (p.options.nonpublic?' <i style="color:#ccc; font-size:75%;">Nonpublic Project</i>':'')+
                (p.options.urgent?' <i style="color:#ccc; font-size:75%;">Urgent Project</i>':'');
            
        document.write('<div>');            
        document.write('<div class="uwf-widget">');
        
        document.write('<div class="uwf-feedback">');

        if(uw_freelancer_obj.show_adname == true){
            document.write('<h4><a href="'+p.url+'">'+ projectTitle + '</a></h4>');
        }     
        
        if(uw_freelancer_obj.show_addesc == true){
            document.write( p.short_descr + '<br /><br />');
        } 
        
        document.write('</div>');
        
        document.write('<div class="uwf-profile-details">');
        
        if(uw_freelancer_obj.show_startdate == true){
            var start = new Date(p.start_unixtime*1000);
            var formattedstart = start.getFullYear() + '-' + start.getMonth() + '-' + start.getDate();
            document.write('<span class="uwf-item">');
            document.write('<span class="uwf-item-header">Posted on: </span>' + formattedstart + '<br />');
            document.write('</span>');
        } 
        if(uw_freelancer_obj.show_enddate == true){
            var end = new Date(p.end_unixtime*1000);
            var formattedend = end.getFullYear() + '-' + end.getMonth() + '-' + end.getDate();
            document.write('<span class="uwf-item">');
            document.write('<span class="uwf-item-header">Bidding ends on : </span>' + formattedend + '<br />');
            document.write('</span>');
        }   
        if(uw_freelancer_obj.show_daysleft == true){
            document.write('<span class="uwf-item">');
            document.write('<span class="uwf-item-header">Days left : </span>' + p.daysLeft + '<br />');
            document.write('</span>');
        }   
        
        if(uw_freelancer_obj.show_bidcount == true){
            document.write('<span class="uwf-item">');
            document.write('<span class="uwf-item-header">Total bids : </span>' + p.bid_stats.count + '<br />');
            document.write('</span>');
        }  
        if(uw_freelancer_obj.show_bidavg == true){
            document.write('<span class="uwf-item">');
            document.write('<span class="uwf-item-header">Bid average : </span>' + p.bid_stats.avg + ' USD<br />');
            document.write('</span>');
        }             
                
            
        if(uw_freelancer_obj.show_budget == true){
            document.write('<span class="uwf-item">');
            document.write('<span class="uwf-item-header">Budget: </span>' + budget + '<br />');
            document.write('</span>');
        }
        
        document.write('</div>');
        
        document.write('<div class="uwf-hire-me-link">');
        document.write('<a class="btn" href="'+p.url+'"><br />Bid on this project<br /><br /></a>');
        document.write('</div>');
        
        document.write('</div></div>'); 
        
    });
    
    }
}