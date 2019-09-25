<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_logged
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('bootstrap.framework');
?>
<table id="<?php echo str_replace(' ', '', $module->title) . $module->id; ?>">
	<caption class="sr-only"><?php echo $module->title; ?></caption>
	<thead>
		<tr>
			<th scope="col">
				<?php if ($params->get('name', 1) == 0) : ?>
					<?php echo Text::_('JGLOBAL_USERNAME'); ?>
				<?php else : ?>
					<?php echo Text::_('MOD_LOGGED_NAME'); ?>
				<?php endif; ?>
			</th>
			<th scope="col" style="width: 70px; white-space: nowrap;"><?php echo Text::_('JCLIENT'); ?></th>
			<th scope="col" style="width: 150px; white-space: nowrap;"><?php echo Text::_('JDATE'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user) : ?>
			<tr>
				<th scope="row">
					<?php if (isset($user->editLink)) : ?>
						<a href="<?php echo $user->editLink; ?>">
							<?php echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?>
						</a>
					<?php else : ?>
						<?php echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?>
					<?php endif; ?>
				</th>
				<td style="white-space: nowrap;">
					<?php if ($user->client_id === null) : ?>
						<?php // Don't display a client ?>
					<?php elseif ($user->client_id) : ?>
						<?php echo Text::_('JADMINISTRATION'); ?>
					<?php else : ?>
						<form action="<?php echo $user->logoutLink; ?>" method="post" name="adminForm">
							<?php echo Text::_('JSITE'); ?>
							<button type="submit" class="mr-2 btn btn-danger btn-sm">
								<?php echo Text::_('JLOGOUT'); ?>
							</button>
						</form>
					<?php endif; ?>
				</td>
				<td style="white-space: nowrap;">
					<?php echo HTMLHelper::_('date', $user->time, Text::_('DATE_FORMAT_LC5')); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
