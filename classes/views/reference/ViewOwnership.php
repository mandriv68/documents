<?php


class ViewOwnership extends AbstractView {
    
        protected function getForm() {
?>   
        <form role="form" class="form-inline" method="post">
            <fieldset>
                <legend>добавление::редактирование должности</legend>
                <div class="row">
                    <div class="form-group col-md-3">
                        <input type="hidden" name="id" value="<?= $this->item_form->id;?>">
                        <p class="p-form">аббревиатура</p>
                        <input type="text" name="abbr" class="form-control w100" value="<?= $this->item_form->abbr;?>">
                    </div>
                    <div class="form-group col-md-6"> 
                        <p class="p-form">полное название<p>
                        <input type="text" name="description" class="form-control w100" value="<?= $this->item_form->description;?>">
                    </div>
                    <div class="col-md-2">
                        <p style="visibility: hidden;" class="p-form">bottom</p>
                        <button type="submit" class="btn btn-red">запомнить</button>
                    </div>
                </div>
                <? $visibility = ' hidden';
                    if($_SESSION['msgs']):
                        $visibility = ' visible';
                    endif;?>
                <div class="msgs <?= $visibility.$_SESSION['msgs'][1]?>">
                    <i class="fa fa-comments-o"></i><?= $_SESSION['msgs'][0]?>
                </div>
            </fieldset>
        </form>
<?php
    }
    
    protected function getTable() {
?>
        <table class="table table-striped table-bordered">
            <tr bgcolor="grey">
                <th align="center" width="10%">№ п/с</th>
                <th align="center" width="20%">аббревиатура</th>
                <th align="center" >полное название</th>
                <th align="center" width="10%">ред...</th>
                <th align="center" width="10%">уд...</th>
            </tr>
<?      $count = 1;
        foreach ($this->items_table as $line):?>
            <tr onclick="location.href='/ownership/get/id/<?= $line->id?>';" class="hover-tr">
                <td align="center"><?= $count?></td>
                <td align="left"><?= $line->abbr?></td>
                <td align="left"><?= $line->description?></td>
                <td class="icon-edit">
                    <a href="/ownership/get/id/<?= $line->id?>" title="редактировать">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
                <td class="icon-del">
                    <a href="/ownership/delete/id/<?= $line->id?>" title="удалить">
                        <i class="fa fa-eraser"></i>
                    </a>

                </td>
            </tr>
<?          $count++;
        endforeach;?>   
        </table>
<?php   }
    
    public function getBody() {
        $this->getHeader();
        $this->getNavbar(TRUE);
        $this->getContent();
        $this->getFooter();
    }
    
}
