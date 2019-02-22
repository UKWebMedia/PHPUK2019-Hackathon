<div class="jumbotron mt-4">
    <h1 class="display-4"><?= $event->name?></h1>
    <p class="lead"><?= $event->description?></p>
    <p><?= $event->start_date->format('D j F y') ?> to <?= $event->end_date->format('D j F Y') ?></p>
</div>

<?= $this->element('navigation');?>

<?php
echo $this->Form->create(null);

$now = new \Cake\I18n\FrozenTime();

foreach ($event->tracks as $track) {
    ?>
    <div>
        <h3><?= $track->track_name;?></h3>
        <ul class="list-unstyled">
        <?php foreach ($track->talks as $talk): ?>
        <?php
         $allow = $talk->start_date > $now;
         ?>
            <li <?= !$allow ? 'style="color:#ccc"' : null?>>
                <?php
                $talkLabel = $talk->start_date->format('D H:i') . ' - ' . $talk->talk_title;
                if (!empty($talk->speakers)) {
                    $talkLabel .= ' with ' . $talk->speakers[0]['speaker_name'];
                }

                echo $this->Form->control(
                    'reminders.' . $talk->id . '.talk_id',
                    [
                        'type' => 'checkbox',
                        'label' => $talkLabel,
                        'value' => $talk->id,
                        'class' => 'mr-3',
                        'disabled' => (!$allow) ? 'disabled' : null,
                        'escape' => false,
                        'hiddenField' => false
                    ]
                );
            ?></li>
        <?php endforeach;?>
        </ul>
    </div>
    <?php
}


echo $this->Form->control('phone_number', ['label' => 'Send me an SMS reminder', 'placeholder' => 'Your phone number', 'required' => true]);
echo "<div class='offset-4 col-md-4'>";
echo $this->Form->button('Remind me ', ['class' => 'btn btn-primary btn-block']);
echo "</div>";
echo $this->Form->end();
