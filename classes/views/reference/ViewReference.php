<?php
class ViewReference extends AbstractView {
    
    protected function getContent() {
?>
<div class="row">
    <? $this->getLeftBar();?>
    <div class="col-md-9">
        <div class="row">
          <?  Dump::vardump($this->cntrl)?>  
        </div>
    </div>
</div>

<?php
    }
    
    public function getBody() {
        $this->getHeader();
        $this->getNavbar(TRUE);
        $this->getContent();
        $this->getFooter();
    }
    
}
