<?php

class ViewMain extends AbstractView{
    
    protected function getContent() {
?>
<div class="row">
    <? $this->getLeftBar();?>
    <div class="col-md-9">
        <? $this->getCompanyName()?>
        <div class="row">
            <div class="col-md-4 main-item">
                <div class="thumbnail main-item-block">
                    <img src="../../images/reference.jpg" alt="...">
                    <div class="caption">
                        <a href="/reference/main"><h3>справочники</h3></a>
                        <ul>
                            <?php
                            $ref = Config::getReferenceConfig();                            $this->getItemsBox($ref);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 main-item">
                <div class="thumbnail main-item-block">
                    <img src="../../images/doc.jpg" alt="...">
                    <div class="caption">
                        <a href="/doc/main"><h3>документы</h3></a>
                        <ul>
                            <?php
                            $docs = Config::getDocConfig();
                            $this->getItemsBox($docs);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 main-item">
                <div class="thumbnail main-item-block">
                    <img src="../../images/archiv.jpg" alt="...">
                    <div class="caption">
                        <a href="/archives/main"><h3>архивы</h3></a>
                        <ul>
                            <?php
                            $arc = Config::getArchivesConfig();
                            $this->getItemsBox($arc);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php
    }
    
    private function getItemsBox($items) {
        foreach ($items as $controller => $item) {
            list($i_class,$menu_item) = each($item);
            echo '<li>'
                    .'<a href="/'.$controller.'/main">'
                        .'<i class="'.$i_class.'"></i>&nbsp'.$menu_item.
                     '</a>'.
                  '</li>';
        }
    }
    
    public function getBody() {
        $this->getHeader();
        $this->getNavbar(TRUE);
        $this->getContent();
        $this->getFooter();
    }
    
}
