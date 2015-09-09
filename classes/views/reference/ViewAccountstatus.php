<?php

class ViewAccountstatus extends AbstractView {
        
    protected function getContent() {
?>
<div class="row">
    <? $this->getLeftBar();?>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12 bottom15">
                <? $this->getForm()?>
            </div>
            <div class="col-md-12">
<?php           $this->getTable();
                if ($_SESSION['result']):
                    echo '<p>'. $_SESSION['result'].'</p>';
                    unset($_SESSION['result']);
                endif;
?>
            </div>
        </div>
    </div>
</div>
<?php
        unset($_SESSION['msgs']);
    }
    
    protected function getTable() {
?>
        <table class="table table-striped table-bordered">
                    <tr bgcolor="grey">
                        <th align="center" width="10%">id</th>
                        <th align="center" >назначение счёта</th>
                        <th align="center" width="10%">ред...</th>
                        <th align="center" width="10%">уд...</th>
                    </tr>
<?php   $count = 1;
        foreach ($this->items_table as $line):?>
                    <tr onclick="location.href='/accountstatus/get/id/<?= $line->id?>';" class="hover-tr">
                        <td align="center"><?= $count?></td>
                        <td align="left"><?= $line->namestatus?></td>
                        <td class="icon-edit">
                            <a href="/accountstatus/get/id/<?= $line->id?>" title="редактировать">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                        </td>
                        <td class="icon-del">
                            <a href="/accountstatus/delete/id/<?= $line->id?>" title="удалить">
                                <i class="fa fa-eraser"></i>
                            </a>

                        </td>
                    </tr>
<?php       $count++;
        endforeach;?>   
                </table>
<?php
    }
    
    protected function getForm() {
?>
    <form role="form" class="form-inline" method="post">
                    <fieldset>
                        <legend>добавление::редактирование назначения счёта</legend>
                        <div class="col-md-10 form-group">
                            <label for="namestatus">назначение счёта</label>
                            <input type="hidden" name="id" value="<?= $this->item_form->id?>">
                            <input type="text" name="namestatus" class="form-control w70" id="namestatus" placeholder="Введите назначение счёта" value="<?= $this->item_form->namestatus?>">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-red">запомнить</button>
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


    public function getBody() {
        $this->getHeader();
        $this->getNavbar(TRUE);
        $this->getContent();
        $this->getFooter();
    }
}

