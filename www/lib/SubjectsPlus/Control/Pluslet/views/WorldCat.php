<base target="_top">

<div><!--begin WorldCat section-->
    
<script type="text/javascript">
function ddtabcontent(tabinterfaceid){
    this.tabinterfaceid=tabinterfaceid //ID of Tab Menu main container
    this.tabs=document.getElementById(tabinterfaceid).getElementsByTagName("a") //Get all tab links within container
    this.currentTabId="";
    this.fqs = new Object();
    this.fqs["all"] = {fq:"",qt:"affiliate_wc_org_all"};
    this.fqs["books"] = {fq:"dt:bks",qt:"affiliate_wc_bks"};
    this.fqs["dvds"] = {fq:"fm:dvv",qt:"affiliate_wc_dvv"};
    this.fqs["cds"] = {fq:"fm:cda",qt:"affiliate_wc_cda"};
    this.fqs["arts"] = {fq:"dt:art",qt:"affiliate_wc_art"};
    this.fqs["aubs"] = {fq:"fm:nsr",qt:"affiliate_wc_nsr"};
    this.fqs["irs"] = {fq:"dt:url",qt:"affiliate_wc_url"};
}

ddtabcontent.prototype={
    expandtab:function(tabref){
        var subcontentid=tabref.getAttribute("rel") //Get id of subcontent to expand
        for (var i=0; i<this.tabs.length; i++){ //Loop through all tabs, and assign only the selected tab the CSS class "selected"
            this.tabs[i].className=(this.tabs[i].getAttribute("rel")==subcontentid)? "selected" : ""
        }
        this.currentTabId=subcontentid;
        var journalid = document.getElementById("journalsearch");
        var bottomdiv = document.getElementById("bottomdiv");
        var journalid_html = '<label for="source" class="wcat-label">Limit to journal/magazine: </label><br />' +
                             '<input type="text" name="source" id="source" value="" /><br />' +
                             '<img src="https://www.worldcat.org/searchbox/images/wclocal_srchwc.gif?ai=SubjectsPlus" width="104" height="16" align="absmiddle" alt="Search with WorldCat" title="Search with WorldCat" />';
        if (subcontentid =="arts") {
          if (journalid) {
            journalid.style.display = "block";
            journalid.innerHTML = journalid_html;
          }
          if (bottomdiv) {
            bottomdiv.style.display = "none";
          }
        } else {
          if (journalid) {
            journalid.style.display = "none";
            journalid.innerHTML = "";
          }
          if (bottomdiv) {
            bottomdiv.style.display = "block";
          }
        }
    },

    init:function(){
        var selectedtab=-1 //Currently selected tab index (-1 meaning none)
        for (var i=0; i<this.tabs.length; i++){
            if (this.tabs[i].getAttribute("rel")){
                var tabinstance=this
                this.tabs[i].onclick=function(){
                    tabinstance.expandtab(this)
                    return false
                }
                if (this.tabs[i].className=="selected"){
                    selectedtab=i //Selected tab index, if found
                }
            }
        } //END for loop
        if (selectedtab!=-1) //if a valid default selected tab index is found
            this.expandtab(this.tabs[selectedtab]) //expand selected tab (either from URL parameter, persistent feature, or class="selected" class)
        else //if no valid default selected index found
            this.expandtab(this.tabs[0]) //Just select first tab that contains a "rel" attr
    } //END int() function

} //END Prototype assignment

function checkSearchForm() {
  // reset the form value
  var subcontentid = searchtypes.currentTabId;
  if (searchtypes.fqs[subcontentid] && searchtypes.fqs[subcontentid].fq!=null) {
    document.wcfw.fq.value = searchtypes.fqs[subcontentid].fq;
  } else {
    document.wcfw.fq.value = "";
  }

  if (searchtypes.fqs[subcontentid] && searchtypes.fqs[subcontentid].qt) {
    document.wcfw.qt.value = searchtypes.fqs[subcontentid].qt;
  } else {
    document.wcfw.qt.value = "affiliate_wc_org_all";
  }

  return true;
}
</script>


<div id="div-search">

    <?php

    global $worldcat_search_url;

    ?>

    <form name="wcfw" id="wcfw" method="get" accept-charset="UTF-8" action="<?php echo($worldcat_search_url); ?>" target="_blank" onsubmit="return checkSearchForm()" class="pure-form">

        <fieldset>
            <input type="hidden" name="qt" value="affiliate_wc_org_all">
            <input type="hidden" name="ai" value="SubjectsPlus">
            <input type="hidden" name="fq" value="">
            <legend>Find items in libraries near you</legend>

            <ul id="searchtabs" class="shadetabs">
              <li><a rel="all" class="selected">Everything</a></li>
                <li><a rel="books" class="">Books</a></li>
                <li><a rel="dvds" class="">DVDs</a></li>
                <li><a rel="cds" class="">CDs</a></li>
                <li><a rel="arts" class="">Articles</a></li>
            </ul>

            <div id="box">
                <input type="text" name="q" id="q" maxlength="80">
                <input type="submit" value="Search" name="wcsbtn2w" id="wcsbtn2w" alt="Search" title="Search" class="pure-button pure-button-pluslet">                  
                <div id="journalsearch" style="display: none;"></div>
            </div>

            <div id="bottomdiv" align="left" style="display: block;">
                <a href="https://worldcat.org/advancedsearch">Advanced Search</a>
            </div>

            <script type="text/javascript">
                var searchtypes=new ddtabcontent("searchtabs");
                searchtypes.init();
            </script>

        </fieldset>

    </form>
    
</div> <!--end div-search-->
</div> <!--end WorldCat section-->
