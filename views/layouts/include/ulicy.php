<?php 

use yii\helpers\Url;
use app\helpers\CustomHelper;
use app\helpers\VariableHelper;
use app\helpers\UrlHelper;
use app\models\City;
use app\models\Menu;
use app\models\Master;
use app\models\Page;
use app\models\Review;
use app\models\Blocktechnical;
use app\models\Setting;


?>



<?php if (!empty(Yii::$app->params['page']['block_ulicy_visible'])): ?>
    <?php 
        $street = Yii::$app->params['city']['street-url'] ?? null;
    ?>
    <?php if (!empty($street)): ?>
        <h2 class="mt30 mb30 text-center">Оказываем услуги на всех улицах города</h2>
        <div class="ulicy">
            <?php
                $ra = $street;
                $seed = Yii::$app->params['page']['id'];
                if (!empty(Yii::$app->params['street-srand'])) {
                    $seed += Yii::$app->params['street-srand'];
                }
                srand($seed);
                $keys_count = count($ra);
                if ($keys_count > 60) {
                    $keys_count = 60;
                }
                $random_keys = array_rand($ra, $keys_count);
            ?>
            <?php for($i = 0; $i < $keys_count; $i++): ?>
                <?php if (!empty(Yii::$app->params['street']) && !empty(Yii::$app->params['street']['name']) && Yii::$app->params['street']['name'] === $ra[$random_keys[$i]][0]) {
                    continue;
                } ?>
                <?php if (!empty($ra[$random_keys[$i]][1])): ?>
                    <a href="<?= UrlHelper::to(['page' => '/address/'.$ra[$random_keys[$i]][1].'/']) ?> " class="ulica"><?= $ra[$random_keys[$i]][0] ?></a>
                <?php else: ?>
                    <span class="ulica"><?= $ra[$random_keys[$i]][0] ?></span>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>