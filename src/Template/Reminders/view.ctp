<?= $this->element('navigation');?>

<h1>View reminders</h1>
<p>Enter your phone number to retrieve your reminders.</p>
<?php
echo $this->Form->create(null);
echo $this->Form->control('phone_number', ['label' => false, 'placeholder' => 'Phone number', 'required' => true]);
echo $this->Form->button('Submit', ['class' => 'btn btn-primary']);
?>

<hr>

<?php
if (isset($reminders) && !$reminders->isEmpty()) {
    echo "<ul class='list-unstyled'>";
    foreach ($reminders as $reminder) {
        $style = '';
        if ($reminder->talk->start_date->isPast()) {
            $style = 'color:#ccc';
        }
        echo "<li style='$style'>";
        echo $reminder->talk->start_date->format('D H:i');
        echo ' - ';
        echo $reminder->talk->talk_title;
        echo ' - ';
        echo $reminder->talk->tracks[0]['track_name'];
        echo "</li>";
    }
    echo "</ul>";
}
