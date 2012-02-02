<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title>Hyplexdemo </title>
  <subtitle>Promotional offers</subtitle>
  <link href="" rel="self"/>
  <link href=""/>
  <updated></updated>
  <author><name>Hyplexdemo</name></author>
  <id>Unique Id</id>
  
  
  <?php foreach($arDatas as $key=>$data): ?>
  
  <entry>
      <title>
        <?php echo $data['title'] ?> 
      </title>
      <updated>From: <?php echo format_date($data['date']->format('Y-m'), 'D') ?></updated>
      <link href="<?php echo url_for('homepage') ?>" />
      <id><?php echo sha1($key) ?></id>
      <updated>aaa</updated>
      <summary type="xhtml">
       <div xmlns="http://www.w3.org/1999/xhtml">
           
           <div>
             <a href="<?php //echo $job->getUrl() ?>">
               <img src="http://<?php echo $sf_request->getHost().'/images/'.$data['image'] ?>"
                 alt="<?php echo $data['title'] ?> logo" width="13%" />
             </a>
           </div>
           
           
         
 
         <div>
           <?php echo simple_format_text($data['description']) ?>
         </div>
         <pubDate>From: <?php echo format_date($data['date']->format('Y-m'), 'D') ?></pubDate>
         <h3>Starting at: <?php echo format_currency($data['price'], '$') ?></h3>
         
 
         <p><?php //echo $job->getHowToApply() ?></p>
       </div>
      </summary>
      <author>
        <name><?php //echo $job->getCompany() ?></name>
      </author>
    </entry>
  
  <?php endforeach; ?>
  
 
</feed>