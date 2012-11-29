<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a href="<?php echo $this->url->link('module/constants/add','token='.$this->session->data['token'],'SSL'); ?>" class="button"><?php echo $this->language->get('button_insert'); ?></a></div>
    </div>
    <div class="content">
        <table class="list">
          <thead>
            <tr>
            	<td class="left"><?php echo $this->language->get('entry_id');?> </td>
            	<td class="left"><?php echo $this->language->get('entry_alias');?> </td>
            	<td class="left"><?php echo $this->language->get('entry_title');?> </td>
            	<td></td>
            </tr>
          </thead>
          <?php foreach ($items as $item) { ?>
          <tbody>
            <tr>
            	<td class="left"><?php echo $item['id']; ?></td>
            	<td class="left"><?php echo $item['alias'];?></td>
            	<td class="left"><?php echo $item['title'];?></td>
              <td class="left"><a href="<?php echo $this->url->link('module/constants/edit','itemId='.$item['id'].'&token='.$this->session->data['token'],'SSL');?>" class="button"><?php echo $this->language->get('button_edit'); ?></a>
              	<a href="<?php echo $this->url->link('module/constants/del','itemId='.$item['id'].'&token='.$this->session->data['token'],'SSL');?>" class="button"><?php echo $this->language->get('button_remove'); ?></a></td>
            </tr>
          </tbody>
          <?php } ?>
        </table>
    </div>
  </div>
</div>
<?php echo $footer; ?>