<?php

Form::macro('input_group', function ($app) {
    $html =
        '<div class="input-group">
					<input type="text" class="form-control" disabled="disabled" name="'.$app['name'].'" id="'.$app['name'].'">
					<span class="input-group-addon" id="btn-'.$app['name'].'" style="cursor: pointer;">'.$app['text'].'</span>
				</div><br/>';

    return $html;
});
