<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use portalLogia\Posts;

/**
* 
*/
class postTableSeeder extends Seeder
{
	
	public function run()
	{
		Posts::create(
						[
							'title' => 'Post de Prueba',
							'content' => 'Lorem ipsum dolor sit amet, tota inermis deserunt quo at, agam habemus dolores his no. Est simul ignota ei, vide vocent deleniti at pri, labore postulant his in. Elitr soleat populo eum te. Semper delicatissimi per ut, duo debitis sensibus id, ut sed ullum evertitur reformidans. Eam reprimique constituam ullamcorper ne, epicurei senserit constituam eum id.

His eu nobis argumentum, dicta omnesque mei an, eu vix dolorum denique euripidis. Cu ubique voluptua incorrupte mea. Alii scriptorem ei vix. Duo audiam blandit nominavi in. Quo id nostrum gubergren, cum modo aperiri delicata ea. Mea utinam vivendo detraxit in, insolens recusabo consulatu an sit.

Sed et graeci admodum quaestio, ea eam latine noluisse consetetur. Eum ut gubergren efficiendi, errem propriae iracundia ad eam. At duis movet eos, eu error consetetur qui. Cu movet omnesque duo, sea ei agam nulla assueverit.

Mucius doming sadipscing an quo, mea facilisi urbanitas voluptatibus ne. At cum omnes quaeque, eu quas persecuti vis, meliore lucilius nominati id quo. In unum deserunt eloquentiam per, ad usu lorem facilisis, no pri dicant honestatis. Id nam dicam accusamus suscipiantur, cu ius quaeque consectetuer. Omittantur neglegentur et ius, ex errem eruditi aliquando his. Ea has sonet ubique tincidunt, eum clita repudiare in.

Ex pri sapientem vituperata consectetuer. Pri primis abhorreant honestatis ad, in rebum erant usu, unum prompta facilisis quo eu. Pro ad reque dicant populo, decore facete ei vis, no qui purto perfecto. Ius cu aliquid democritum, mollis volutpat intellegat id eum, te modo invenire definitiones nam. Vis zril imperdiet in, ea pri sale graecis.',
							'tags' => 'tags,tutorial,ahiva',
							'photo' => 'http://lorempixel.com/720/480/city/1',
							'autor' => 'Alberto de la Rocha',
							'estatus' => 'nopublicar'
						]

					);

		Posts::create(
						[
							'title' => 'Post de Prueba2',
							'content' => 'Lorem ipsum dolor sit amet, tota inermis deserunt quo at, agam habemus dolores his no. Est simul ignota ei, vide vocent deleniti at pri, labore postulant his in. Elitr soleat populo eum te. Semper delicatissimi per ut, duo debitis sensibus id, ut sed ullum evertitur reformidans. Eam reprimique constituam ullamcorper ne, epicurei senserit constituam eum id.

His eu nobis argumentum, dicta omnesque mei an, eu vix dolorum denique euripidis. Cu ubique voluptua incorrupte mea. Alii scriptorem ei vix. Duo audiam blandit nominavi in. Quo id nostrum gubergren, cum modo aperiri delicata ea. Mea utinam vivendo detraxit in, insolens recusabo consulatu an sit.

Sed et graeci admodum quaestio, ea eam latine noluisse consetetur. Eum ut gubergren efficiendi, errem propriae iracundia ad eam. At duis movet eos, eu error consetetur qui. Cu movet omnesque duo, sea ei agam nulla assueverit.

Mucius doming sadipscing an quo, mea facilisi urbanitas voluptatibus ne. At cum omnes quaeque, eu quas persecuti vis, meliore lucilius nominati id quo. In unum deserunt eloquentiam per, ad usu lorem facilisis, no pri dicant honestatis. Id nam dicam accusamus suscipiantur, cu ius quaeque consectetuer. Omittantur neglegentur et ius, ex errem eruditi aliquando his. Ea has sonet ubique tincidunt, eum clita repudiare in.

Ex pri sapientem vituperata consectetuer. Pri primis abhorreant honestatis ad, in rebum erant usu, unum prompta facilisis quo eu. Pro ad reque dicant populo, decore facete ei vis, no qui purto perfecto. Ius cu aliquid democritum, mollis volutpat intellegat id eum, te modo invenire definitiones nam. Vis zril imperdiet in, ea pri sale graecis.',
							'tags' => 'tags,tutorial,ahiva',
							'photo' => 'http://lorempixel.com/720/480/city/2',
							'autor' => 'Alberto de la Rocha',
							'estatus' => 'nopublicar'
						]

					);

		Posts::create(
						[
							'title' => 'Post de Prueba3',
							'content' => 'Lorem ipsum dolor sit amet, tota inermis deserunt quo at, agam habemus dolores his no. Est simul ignota ei, vide vocent deleniti at pri, labore postulant his in. Elitr soleat populo eum te. Semper delicatissimi per ut, duo debitis sensibus id, ut sed ullum evertitur reformidans. Eam reprimique constituam ullamcorper ne, epicurei senserit constituam eum id.

His eu nobis argumentum, dicta omnesque mei an, eu vix dolorum denique euripidis. Cu ubique voluptua incorrupte mea. Alii scriptorem ei vix. Duo audiam blandit nominavi in. Quo id nostrum gubergren, cum modo aperiri delicata ea. Mea utinam vivendo detraxit in, insolens recusabo consulatu an sit.

Sed et graeci admodum quaestio, ea eam latine noluisse consetetur. Eum ut gubergren efficiendi, errem propriae iracundia ad eam. At duis movet eos, eu error consetetur qui. Cu movet omnesque duo, sea ei agam nulla assueverit.

Mucius doming sadipscing an quo, mea facilisi urbanitas voluptatibus ne. At cum omnes quaeque, eu quas persecuti vis, meliore lucilius nominati id quo. In unum deserunt eloquentiam per, ad usu lorem facilisis, no pri dicant honestatis. Id nam dicam accusamus suscipiantur, cu ius quaeque consectetuer. Omittantur neglegentur et ius, ex errem eruditi aliquando his. Ea has sonet ubique tincidunt, eum clita repudiare in.

Ex pri sapientem vituperata consectetuer. Pri primis abhorreant honestatis ad, in rebum erant usu, unum prompta facilisis quo eu. Pro ad reque dicant populo, decore facete ei vis, no qui purto perfecto. Ius cu aliquid democritum, mollis volutpat intellegat id eum, te modo invenire definitiones nam. Vis zril imperdiet in, ea pri sale graecis.',
							'tags' => 'tags,tutorial,ahiva',
							'photo' => 'http://lorempixel.com/720/480/city/3',
							'autor' => 'Alberto de la Rocha',
							'estatus' => 'nopublicar'
						]

					);

Posts::create(
						[
							'title' => 'Post de Prueba',
							'content' => 'Lorem ipsum dolor sit amet, tota inermis deserunt quo at, agam habemus dolores his no. Est simul ignota ei, vide vocent deleniti at pri, labore postulant his in. Elitr soleat populo eum te. Semper delicatissimi per ut, duo debitis sensibus id, ut sed ullum evertitur reformidans. Eam reprimique constituam ullamcorper ne, epicurei senserit constituam eum id.

His eu nobis argumentum, dicta omnesque mei an, eu vix dolorum denique euripidis. Cu ubique voluptua incorrupte mea. Alii scriptorem ei vix. Duo audiam blandit nominavi in. Quo id nostrum gubergren, cum modo aperiri delicata ea. Mea utinam vivendo detraxit in, insolens recusabo consulatu an sit.

Sed et graeci admodum quaestio, ea eam latine noluisse consetetur. Eum ut gubergren efficiendi, errem propriae iracundia ad eam. At duis movet eos, eu error consetetur qui. Cu movet omnesque duo, sea ei agam nulla assueverit.

Mucius doming sadipscing an quo, mea facilisi urbanitas voluptatibus ne. At cum omnes quaeque, eu quas persecuti vis, meliore lucilius nominati id quo. In unum deserunt eloquentiam per, ad usu lorem facilisis, no pri dicant honestatis. Id nam dicam accusamus suscipiantur, cu ius quaeque consectetuer. Omittantur neglegentur et ius, ex errem eruditi aliquando his. Ea has sonet ubique tincidunt, eum clita repudiare in.

Ex pri sapientem vituperata consectetuer. Pri primis abhorreant honestatis ad, in rebum erant usu, unum prompta facilisis quo eu. Pro ad reque dicant populo, decore facete ei vis, no qui purto perfecto. Ius cu aliquid democritum, mollis volutpat intellegat id eum, te modo invenire definitiones nam. Vis zril imperdiet in, ea pri sale graecis.',
							'tags' => 'tags,tutorial,ahiva',
							'photo' => 'http://lorempixel.com/720/480/city/4',
							'autor' => 'Alberto de la Rocha',
							'estatus' => 'publicar'
						]

					);

		Posts::create(
						[
							'title' => 'Post de Prueba2',
							'content' => 'Lorem ipsum dolor sit amet, tota inermis deserunt quo at, agam habemus dolores his no. Est simul ignota ei, vide vocent deleniti at pri, labore postulant his in. Elitr soleat populo eum te. Semper delicatissimi per ut, duo debitis sensibus id, ut sed ullum evertitur reformidans. Eam reprimique constituam ullamcorper ne, epicurei senserit constituam eum id.

His eu nobis argumentum, dicta omnesque mei an, eu vix dolorum denique euripidis. Cu ubique voluptua incorrupte mea. Alii scriptorem ei vix. Duo audiam blandit nominavi in. Quo id nostrum gubergren, cum modo aperiri delicata ea. Mea utinam vivendo detraxit in, insolens recusabo consulatu an sit.

Sed et graeci admodum quaestio, ea eam latine noluisse consetetur. Eum ut gubergren efficiendi, errem propriae iracundia ad eam. At duis movet eos, eu error consetetur qui. Cu movet omnesque duo, sea ei agam nulla assueverit.

Mucius doming sadipscing an quo, mea facilisi urbanitas voluptatibus ne. At cum omnes quaeque, eu quas persecuti vis, meliore lucilius nominati id quo. In unum deserunt eloquentiam per, ad usu lorem facilisis, no pri dicant honestatis. Id nam dicam accusamus suscipiantur, cu ius quaeque consectetuer. Omittantur neglegentur et ius, ex errem eruditi aliquando his. Ea has sonet ubique tincidunt, eum clita repudiare in.

Ex pri sapientem vituperata consectetuer. Pri primis abhorreant honestatis ad, in rebum erant usu, unum prompta facilisis quo eu. Pro ad reque dicant populo, decore facete ei vis, no qui purto perfecto. Ius cu aliquid democritum, mollis volutpat intellegat id eum, te modo invenire definitiones nam. Vis zril imperdiet in, ea pri sale graecis.',
							'tags' => 'tags,tutorial,ahiva',
							'photo' => 'http://lorempixel.com/720/480/city/5',
							'autor' => 'Alberto de la Rocha',
							'estatus' => 'nopublicar'
						]

					);

		Posts::create(
						[
							'title' => 'Post de Prueba3',
							'content' => 'Lorem ipsum dolor sit amet, tota inermis deserunt quo at, agam habemus dolores his no. Est simul ignota ei, vide vocent deleniti at pri, labore postulant his in. Elitr soleat populo eum te. Semper delicatissimi per ut, duo debitis sensibus id, ut sed ullum evertitur reformidans. Eam reprimique constituam ullamcorper ne, epicurei senserit constituam eum id.

His eu nobis argumentum, dicta omnesque mei an, eu vix dolorum denique euripidis. Cu ubique voluptua incorrupte mea. Alii scriptorem ei vix. Duo audiam blandit nominavi in. Quo id nostrum gubergren, cum modo aperiri delicata ea. Mea utinam vivendo detraxit in, insolens recusabo consulatu an sit.

Sed et graeci admodum quaestio, ea eam latine noluisse consetetur. Eum ut gubergren efficiendi, errem propriae iracundia ad eam. At duis movet eos, eu error consetetur qui. Cu movet omnesque duo, sea ei agam nulla assueverit.

Mucius doming sadipscing an quo, mea facilisi urbanitas voluptatibus ne. At cum omnes quaeque, eu quas persecuti vis, meliore lucilius nominati id quo. In unum deserunt eloquentiam per, ad usu lorem facilisis, no pri dicant honestatis. Id nam dicam accusamus suscipiantur, cu ius quaeque consectetuer. Omittantur neglegentur et ius, ex errem eruditi aliquando his. Ea has sonet ubique tincidunt, eum clita repudiare in.

Ex pri sapientem vituperata consectetuer. Pri primis abhorreant honestatis ad, in rebum erant usu, unum prompta facilisis quo eu. Pro ad reque dicant populo, decore facete ei vis, no qui purto perfecto. Ius cu aliquid democritum, mollis volutpat intellegat id eum, te modo invenire definitiones nam. Vis zril imperdiet in, ea pri sale graecis.',
							'tags' => 'tags,tutorial,ahiva',
							'photo' => 'http://lorempixel.com/720/480/city/6',
							'autor' => 'Alberto de la Rocha',
							'estatus' => 'publicar'
						]

					);
Posts::create(
						[
							'title' => 'Post de Prueba',
							'content' => 'Lorem ipsum dolor sit amet, tota inermis deserunt quo at, agam habemus dolores his no. Est simul ignota ei, vide vocent deleniti at pri, labore postulant his in. Elitr soleat populo eum te. Semper delicatissimi per ut, duo debitis sensibus id, ut sed ullum evertitur reformidans. Eam reprimique constituam ullamcorper ne, epicurei senserit constituam eum id.

His eu nobis argumentum, dicta omnesque mei an, eu vix dolorum denique euripidis. Cu ubique voluptua incorrupte mea. Alii scriptorem ei vix. Duo audiam blandit nominavi in. Quo id nostrum gubergren, cum modo aperiri delicata ea. Mea utinam vivendo detraxit in, insolens recusabo consulatu an sit.

Sed et graeci admodum quaestio, ea eam latine noluisse consetetur. Eum ut gubergren efficiendi, errem propriae iracundia ad eam. At duis movet eos, eu error consetetur qui. Cu movet omnesque duo, sea ei agam nulla assueverit.

Mucius doming sadipscing an quo, mea facilisi urbanitas voluptatibus ne. At cum omnes quaeque, eu quas persecuti vis, meliore lucilius nominati id quo. In unum deserunt eloquentiam per, ad usu lorem facilisis, no pri dicant honestatis. Id nam dicam accusamus suscipiantur, cu ius quaeque consectetuer. Omittantur neglegentur et ius, ex errem eruditi aliquando his. Ea has sonet ubique tincidunt, eum clita repudiare in.

Ex pri sapientem vituperata consectetuer. Pri primis abhorreant honestatis ad, in rebum erant usu, unum prompta facilisis quo eu. Pro ad reque dicant populo, decore facete ei vis, no qui purto perfecto. Ius cu aliquid democritum, mollis volutpat intellegat id eum, te modo invenire definitiones nam. Vis zril imperdiet in, ea pri sale graecis.',
							'tags' => 'tags,tutorial,ahiva',
							'photo' => 'http://lorempixel.com/720/480/city/7',
							'autor' => 'Alberto de la Rocha',
							'estatus' => 'publicar'
						]

					);

		Posts::create(
						[
							'title' => 'Post de Prueba2',
							'content' => 'Lorem ipsum dolor sit amet, tota inermis deserunt quo at, agam habemus dolores his no. Est simul ignota ei, vide vocent deleniti at pri, labore postulant his in. Elitr soleat populo eum te. Semper delicatissimi per ut, duo debitis sensibus id, ut sed ullum evertitur reformidans. Eam reprimique constituam ullamcorper ne, epicurei senserit constituam eum id.

His eu nobis argumentum, dicta omnesque mei an, eu vix dolorum denique euripidis. Cu ubique voluptua incorrupte mea. Alii scriptorem ei vix. Duo audiam blandit nominavi in. Quo id nostrum gubergren, cum modo aperiri delicata ea. Mea utinam vivendo detraxit in, insolens recusabo consulatu an sit.

Sed et graeci admodum quaestio, ea eam latine noluisse consetetur. Eum ut gubergren efficiendi, errem propriae iracundia ad eam. At duis movet eos, eu error consetetur qui. Cu movet omnesque duo, sea ei agam nulla assueverit.

Mucius doming sadipscing an quo, mea facilisi urbanitas voluptatibus ne. At cum omnes quaeque, eu quas persecuti vis, meliore lucilius nominati id quo. In unum deserunt eloquentiam per, ad usu lorem facilisis, no pri dicant honestatis. Id nam dicam accusamus suscipiantur, cu ius quaeque consectetuer. Omittantur neglegentur et ius, ex errem eruditi aliquando his. Ea has sonet ubique tincidunt, eum clita repudiare in.

Ex pri sapientem vituperata consectetuer. Pri primis abhorreant honestatis ad, in rebum erant usu, unum prompta facilisis quo eu. Pro ad reque dicant populo, decore facete ei vis, no qui purto perfecto. Ius cu aliquid democritum, mollis volutpat intellegat id eum, te modo invenire definitiones nam. Vis zril imperdiet in, ea pri sale graecis.',
							'tags' => 'tags,tutorial,ahiva',
							'photo' => 'http://lorempixel.com/720/480/city/8',
							'autor' => 'Alberto de la Rocha',
							'estatus' => 'publicar'
						]

					);

		Posts::create(
						[
							'title' => 'Post de Prueba3',
							'content' => 'Lorem ipsum dolor sit amet, tota inermis deserunt quo at, agam habemus dolores his no. Est simul ignota ei, vide vocent deleniti at pri, labore postulant his in. Elitr soleat populo eum te. Semper delicatissimi per ut, duo debitis sensibus id, ut sed ullum evertitur reformidans. Eam reprimique constituam ullamcorper ne, epicurei senserit constituam eum id.

His eu nobis argumentum, dicta omnesque mei an, eu vix dolorum denique euripidis. Cu ubique voluptua incorrupte mea. Alii scriptorem ei vix. Duo audiam blandit nominavi in. Quo id nostrum gubergren, cum modo aperiri delicata ea. Mea utinam vivendo detraxit in, insolens recusabo consulatu an sit.

Sed et graeci admodum quaestio, ea eam latine noluisse consetetur. Eum ut gubergren efficiendi, errem propriae iracundia ad eam. At duis movet eos, eu error consetetur qui. Cu movet omnesque duo, sea ei agam nulla assueverit.

Mucius doming sadipscing an quo, mea facilisi urbanitas voluptatibus ne. At cum omnes quaeque, eu quas persecuti vis, meliore lucilius nominati id quo. In unum deserunt eloquentiam per, ad usu lorem facilisis, no pri dicant honestatis. Id nam dicam accusamus suscipiantur, cu ius quaeque consectetuer. Omittantur neglegentur et ius, ex errem eruditi aliquando his. Ea has sonet ubique tincidunt, eum clita repudiare in.

Ex pri sapientem vituperata consectetuer. Pri primis abhorreant honestatis ad, in rebum erant usu, unum prompta facilisis quo eu. Pro ad reque dicant populo, decore facete ei vis, no qui purto perfecto. Ius cu aliquid democritum, mollis volutpat intellegat id eum, te modo invenire definitiones nam. Vis zril imperdiet in, ea pri sale graecis.',
							'tags' => 'tags,tutorial,ahiva',
							'photo' => 'http://lorempixel.com/720/480/city/9',
							'autor' => 'Alberto de la Rocha',
							'estatus' => 'publicar'
						]

					);
		# code...
	}
}