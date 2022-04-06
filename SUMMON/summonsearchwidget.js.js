// JavaScript Document
function search() {
       
         var st = document.getElementById("searchText").value;
         
         var keyword = document.getElementById("keyword").checked;
		
         var author = document.getElementById("author").checked;
		
        // var title = document.getElementById("title").checked;
		  
         var tp = document.getElementById("tp").checked;
		   
       //  var tm = document.getElementById("tm").checked;
         var fto = document.getElementById("fto").checked;
		
         var im = document.getElementById("im").checked;
		  
         var ail = document.getElementById("ail").checked;
        
        
 if (st == '') {

}
else{ 
         if (keyword == true) {
             if (fto == true && im == true && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?s.q=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
             
			 else if (fto == true && im == true && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?s.cmd=addFacetValueFilters(IsScholarly,true)&s.fvf=IsFullText,true,f&s.light=t&s.q=" + st); }
             
			 else if (fto == true && im == false && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?s.q=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29&s.cmd[]=removeFacetValueFilter%28IsScholarly%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
             else if (fto == true && im == false && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?s.cmd=addFacetValueFilters(IsFullText,true)&s.light=t&s.q=" + st); }
             else if (fto == false && im == true && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?s.q=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
             
			 else if (fto == false && im == true && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?s.q=(" + st + ")&s.cmd%5B%5D=addFacetValueFilters%28IsScholarly%2Ctrue%29"); }
             
			 else if (fto == false && im == false && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?s.q=(" + st + ")&s.fq%5B%5D=SourceType%3A%28%22Library+Catalog%22%29"); }
             else {
                 window.open("http://conricytudg.summon.serialssolutions.com/search?ho=t&q=" + st);
             }
            
         }
         else if (author == true) {


             if (fto == true && im == true && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.AuthorCombined=(" + st + ")&s.cmd%5B%5D=addFacetValueFilters%28IsFullText%2Ctrue%29&s.cmd%5B%5D=addFacetValueFilters%28IsScholarly%2Ctrue%29&s.fq%5B%5D=SourceType%3A%28%22Library+Catalog%22%29"); }
             else if (fto == true && im == true && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.AuthorCombined=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29"); }
             else if (fto == true && im == false && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.AuthorCombined=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
             else if (fto == true && im == false && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.AuthorCombined=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29"); }
             else if (fto == false && im == true && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?s.q=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
             else if (fto == false && im == true && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.AuthorCombined=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29"); }
             else if (fto == false && im == false && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.AuthorCombined=(" + st + ")&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
             else {

                 window.open("http://conricytudg.summon.serialssolutions.com/search?ho=t&q=AuthorCombined:(" + st + ")");

             }


         }
         else if (title == true) {
             if (fto == true && im == true && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.TitleCombined=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
             else if (fto == true && im == true && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.TitleCombined=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29"); }
			 
             else if (fto == true && im == false && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.TitleCombined=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
             else if (fto == true && im == false && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.TitleCombined=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29"); }
             else if (fto == false && im == true && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.TitleCombined=(" + st + ")&s.cmd[]=removeFacetValueFilter%28IsFullText%2Ctrue%29&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
             else if (fto == false && im == true && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.TitleCombined=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29"); }
             else if (fto == false && im == false && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.TitleCombined=(" + st + ")&s.cmd[]=removeFacetValueFilter%28IsScholarly%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
             else {
                 window.open("http://conricytudg.summon.serialssolutions.com/search?t.TitleCombined=(" + st + ")");
             }
         }
         else if (tp == true) {
             if (fto == true && im == true && ail == true) { window.open("http://conricytuam.summon.serialssolutions.com/search?t.publicationtitle=colombia&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29)"); }
             else if (fto == true && im == true && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.publicationtitle=colombia&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29"); }
             else if (fto == true && im == false && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.publicationtitle=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29&s.cmd[]=removeFacetValueFilter%28IsScholarly%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
			 
             else if (fto == true && im == false && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.publicationtitle=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsFullText%2Ctrue%29"); }
             else if (fto == false && im == true && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.publicationtitle=(" + st + ")&s.cmd[]=removeFacetValueFilter%28IsFullText%2Ctrue%29&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
			 
             else if (fto == false && im == true && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.publicationtitle=(" + st + ")&s.cmd[]=addFacetValueFilters%28IsScholarly%2Ctrue%29"); }
			 
             else if (fto == false && im == false && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?t.publicationtitle=(" + st + ")&s.cmd[]=removeFacetValueFilter%28IsScholarly%2Ctrue%29&s.fq[]=SourceType%3A%28%22Library+Catalog%22%29"); }
             else {
                 window.open("http://conricytudg.summon.serialssolutions.com/search?ho=t&q=PublicationTitle:(" + st + ")");
             }
         }
		 }
        // else if (tm == true) {
          //   if (fto == true && im == true && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?ho=t&fvf=IsFullText,true,f|IsScholarly,true,f|SourceType,Library Catalog,f&q=SubjectTerms:(" + st + ")"); }
         //    else if (fto == true && im == true && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?ho=t&fvf=IsFullText,true,f|IsScholarly,true,f&q=SubjectTerms:(" + st + ")"); }
           //  else if (fto == true && im == false && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?ho=t&fvf=IsFullText,true,f|SourceType,Library Catalog,f&q=SubjectTerms:(" + st + ")"); }
            // else if (fto == true && im == false && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?ho=t&fvf=IsFullText,true,f&q=SubjectTerms:(" + st + ")"); }
            // else if (fto == false && im == true && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?ho=t&fvf=IsScholarly,true,f|SourceType,Library Catalog,f&q=SubjectTerms:(" + st + ")"); }
            // else if (fto == false && im == true && ail == false) { window.open("http://conricytudg.summon.serialssolutions.com/search?ho=t&fvf=IsScholarly,true,f&q=SubjectTerms:(" + st + ")"); }
            // else if (fto == false && im == false && ail == true) { window.open("http://conricytudg.summon.serialssolutions.com/search?ho=t&fvf=SourceType,Library Catalog,f&q=SubjectTerms:(" + st + ")"); }
             //else {

               //  window.open("http://conricytuam.summon.serialssolutions.com/search?ho=t&q=SubjectTerms:(" + st + ")");
             //}
         //}


     }