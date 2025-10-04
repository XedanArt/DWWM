<?php

namespace App\Command;

use App\Entity\Devblog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Cocur\Slugify\Slugify;

// docker exec -it symfony_php php bin/console app:seed-devblog
#[AsCommand(name: 'app:seed-devblogs')]
class SeedDevblogCommand extends Command
{
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $slugify = new Slugify();

        $entries = [
            [
                'title' => 'Deblog #1 - CRASHTEST : On vous attends nombreux !',
                'content' => "Après le déploiement des serveurs de test, il était temps de mettre à l’épreuve notre première mécanique de raid. Ce week-end, les testeurs ont affronté Le Kraken, une entité abyssale conçue pour tester la coordination, la réactivité et la robustesse du système de combat en groupe.
                Objectif du test
                Ce raid avait pour but de :
                - Évaluer la stabilité du serveur en situation de charge multi-joueurs
                - Tester les mécaniques de synchronisation entre les joueurs
                - Identifier les bugs liés aux compétences, aux collisions et aux timers d’événements
                Ce qui a été observé
                - Le Kraken a bien déclenché ses phases d’attaque cycliques
                - Les effets visuels et sonores ont été correctement synchronisés
                - Quelques désynchronisations mineures ont été relevées en fin de raid
                - Le système de loot n’a pas toujours distribué les récompenses comme prévu
                Retours des testeurs
                Les retours ont été très constructifs :
                - L’ambiance du raid a été saluée pour son intensité
                - La difficulté est jugée “juste mais exigeante”
                - Plusieurs suggestions ont été faites pour améliorer la lisibilité des attaques
                Correctifs en cours
                Nous travaillons actuellement sur :
                - L’optimisation des effets en zone
                - La correction du système de loot
                - L’ajout d’un journal de combat pour faciliter le débrief post-raid
                Et maintenant ?
                Le Kraken retourne dans les abysses… pour l’instant.
                D’autres créatures sont en préparation pour les prochaines phases de test, avec des mécaniques plus complexes et des environnements dynamiques.

                Merci à tous les testeurs pour leur implication. Ce premier raid marque une étape importante dans la construction de notre gameplay coopératif. Le prochain Devblog abordera l’arrivée des rôles avancés et la personnalisation des classes.
                ",
                'date' => '2025-09-01',
                'image' => 'devblog_01.png',
            ],
            [
                'title' => 'Devblog #2 — BETA : Raid test — Le Kraken s’éveille',
                'content' => "Après le déploiement des serveurs de test, il était temps de mettre à l’épreuve notre première mécanique de raid. Ce week-end, les testeurs ont affronté Le Kraken, une entité abyssale conçue pour tester la coordination, la réactivité et la robustesse du système de combat en groupe.
                Objectif du test
                Ce raid avait pour but de :
                - Évaluer la stabilité du serveur en situation de charge multi-joueurs
                - Tester les mécaniques de synchronisation entre les joueurs
                - Identifier les bugs liés aux compétences, aux collisions et aux timers d’événements
                Ce qui a été observé
                - Le Kraken a bien déclenché ses phases d’attaque cycliques
                - Les effets visuels et sonores ont été correctement synchronisés
                - Quelques désynchronisations mineures ont été relevées en fin de raid
                - Le système de loot n’a pas toujours distribué les récompenses comme prévu
                Retours des testeurs
                Les retours ont été très constructifs :
                - L’ambiance du raid a été saluée pour son intensité
                - La difficulté est jugée “juste mais exigeante”
                - Plusieurs suggestions ont été faites pour améliorer la lisibilité des attaques
                Correctifs en cours
                Nous travaillons actuellement sur :
                - L’optimisation des effets en zone
                - La correction du système de loot
                - L’ajout d’un journal de combat pour faciliter le débrief post-raid
                Et maintenant ?
                Le Kraken retourne dans les abysses… pour l’instant.
                D’autres créatures sont en préparation pour les prochaines phases de test, avec des mécaniques plus complexes et des environnements dynamiques.

                Merci à tous les testeurs pour leur implication. Ce premier raid marque une étape importante dans la construction de notre gameplay coopératif. Le prochain Devblog abordera l’arrivée des rôles avancés et la personnalisation des classes.
                ",
                'date' => '2025-09-2',
                'image' => 'devblog_02.png',
            ],
            [
                'title' => 'Devblog #3 — Refonte des inventaires : vers un système plus intuitif',
                'content' => "Après les premiers tests de raid et les retours sur l’expérience utilisateur, il est apparu que notre système d’inventaire nécessitait une refonte en profondeur. Trop rigide, peu lisible, et parfois source de confusion, il ne répondait plus aux exigences de fluidité et d’ergonomie que nous visons pour la plateforme.
                Objectifs de la refonte
                Cette nouvelle version vise à :
                - Simplifier la gestion des objets et des ressources
                - Améliorer la lisibilité des catégories et des types d’objets
                - Offrir une meilleure compatibilité avec les futures mécaniques (craft, échange, personnalisation)
                Ce qui change concrètement
                - L’inventaire est désormais segmenté par onglets dynamiques : équipements, consommables, matériaux, objets de quête
                - Chaque objet dispose d’une fiche détaillée avec effets, rareté, provenance et interactions possibles
                - Le système de tri a été entièrement revu : par type, par date d’acquisition, par rareté ou par usage
                - Les actions rapides (utiliser, équiper, jeter, transférer) sont accessibles en un clic
                Retours des premiers testeurs
                Les retours sont très encourageants :
                - L’interface est jugée “plus claire et agréable à manipuler”
                - Le tri automatique facilite grandement la navigation
                - La nouvelle fiche objet permet de mieux anticiper les choix tactiques
                Prochaines évolutions
                Cette refonte ouvre la voie à plusieurs nouveautés :
                - Intégration d’un système de favoris pour les objets clés
                - Ajout d’un inventaire partagé pour les groupes ou guildes
                - Préparation du système de craft basé sur les ressources collectées

                Ce Devblog marque une étape importante dans notre volonté de rendre l’expérience plus fluide et cohérente. L’inventaire n’est plus un simple conteneur : il devient un outil stratégique au cœur du gameplay.
                À suivre dans le Devblog #4 : “Système de classes : vers une personnalisation avancée”
                ",
                'date' => '2025-09-3',
                'image' => 'devblog_03.png',
            ],
            [
                'title' => 'Devblog #4 — Refonte des classes : vers des identités de jeu plus marquées',
                'content' => "Depuis les premiers tests, une chose est devenue évidente : les classes manquaient de personnalité. Trop génériques, trop proches les unes des autres, elles ne permettaient pas aux joueurs de se projeter pleinement dans un rôle distinct. C’est pourquoi nous avons entrepris une refonte complète du système de classes.
                Objectifs de cette refonte
                L’ambition est claire :
                - Offrir des rôles plus tranchés et complémentaires
                - Introduire des spécialisations évolutives selon le style de jeu
                - Créer une synergie naturelle entre les classes en raid ou en exploration
                Ce qui change concrètement
                - Chaque classe dispose désormais d’un arbre de compétences propre, avec des choix stratégiques à chaque palier
                - Les rôles sont mieux définis : tank, soutien, dégâts, contrôle, avec des mécaniques uniques
                - Les compétences passives et actives sont liées à des archétypes narratifs (ex : - Gardien, Arcaniste, Traqueur)
                - Le système de progression permet de re-spécialiser son personnage sans recommencer
                Retours des premiers testeurs
                Les retours sont très positifs :
                - Les classes sont “plus fun à jouer” et “plus cohérentes dans leur gameplay”
                - Les synergies en groupe sont plus visibles et gratifiantes
                - Le choix des compétences crée un vrai sentiment d’évolution
                Prochaines étapes
                - Ajout de quêtes de classe pour débloquer des compétences avancées
                - Intégration d’un système de maîtrise pour affiner les builds
                - Équilibrage des classes en fonction des retours en raid et PvP

                Cette refonte marque une transition importante : les classes ne sont plus des rôles techniques, mais des identités de jeu à part entière. Chaque joueur peut désormais incarner un style, une philosophie, et une stratégie.
                À suivre dans le Devblog #5...”
                ",
                'date' => '2025-09-4',
                'image' => 'devblog_04.png',
            ],
            [
                'title' => 'Devblog #5 — Déités Cosmiques : la voie divine s’ouvre',
                'content' => "Le système de classes vient tout juste d’être refondu, mais une nouvelle couche de profondeur vient enrichir l’expérience : le choix d’une déité. Ce mécanisme permet aux joueurs d’orienter leur progression selon une affinité divine, influençant leurs compétences, leur style de jeu et même certains événements narratifs.
                Objectifs de cette fonctionnalité
                - Offrir une personnalisation avancée des classes
                - Introduire des bonus passifs et actifs liés à la déité choisie
                - Créer une dimension narrative autour de la foi, des pactes et des serments
                Fonctionnement
                - Chaque joueur peut choisir une déité parmi un panthéon de six entités, chacune incarnant une philosophie : guerre, guérison, chaos, savoir, nature, ou ombre
                - Le choix est irréversible à court terme, mais peut être remis en question via une quête de renoncement
                - Les compétences de classe évoluent selon la déité : un mage affilié à la déesse du savoir n’aura pas les mêmes sorts qu’un mage lié au dieu du chaos
                - Des événements dynamiques peuvent survenir selon la déité dominante dans un groupe ou une région
                Retours des premiers testeurs
                - Le système est jugé “immersif et stratégique”
                - Le choix de la déité donne “un vrai poids aux décisions de build”
                - Certains joueurs ont déjà commencé à théoriser des combinaisons optimales entre classe et foi
                Prochaines étapes
                - Ajout de temples et lieux de culte dans le monde
                - Déploiement des quêtes de serment pour renforcer le lien avec la déité
                - Intégration de bénédictions temporaires lors d’événements communautaires

                Ce Devblog marque une transition vers un univers plus vivant, plus mystique, où les choix du joueur façonnent non seulement son gameplay, mais aussi le monde qui l’entoure.
                À suivre dans le Devblog #6",
                'date' => '2025-09-5',
                'image' => 'devblog_05.png',
            ],
            [
                'title' => 'Devblog #6 — Montures : chevaucher le monde, accompagné.',
                'content' => "Le monde s’agrandit, les distances se creusent, et les joueurs réclamaient depuis longtemps un moyen plus fluide de se déplacer. C’est désormais chose faite : les montures font leur entrée dans l’univers de jeu. Bien plus qu’un simple moyen de transport, elles incarnent une nouvelle dimension de progression, de personnalisation et d’exploration.

                [Objectifs de cette fonctionnalité]
                - Accélérer les déplacements dans les zones ouvertes
                - Introduire une mécanique de collection et d’évolution
                - Renforcer l’immersion avec des créatures liées au lore du monde

                [Fonctionnement]
                - Chaque joueur peut débloquer sa première monture via une quête d’initiation disponible dès le niveau 10
                - Les montures disposent de statistiques propres : vitesse, endurance, capacité de charge
                - Certaines montures sont liées à des déités, offrant des bonus spécifiques selon l’affinité choisie
                - Un système de personnalisation visuelle permet de modifier l’apparence, l’équipement et même les effets visuels

                [Retours des premiers testeurs]
                - Le système est jugé “fluide et agréable à utiliser”
                - Les animations de déplacement et de saut sont “réalistes et bien intégrées”
                - La quête d’obtention est “narrative et bien rythmée”

                [Prochaines évolutions]
                - Ajout de montures volantes pour les zones verticales
                - Déploiement d’un système de dressage pour améliorer les statistiques
                - Intégration de courses et défis communautaires liés aux montures

                Ce Devblog marque une avancée vers un monde plus vivant et plus mobile. Les montures ne sont pas qu’un outil : elles deviennent des compagnons de route, des symboles de statut, et parfois même des clés d’accès à des zones secrètes.
                À suivre dans le Devblog #7...",
                'date' => '2025-09-6',
                'image' => 'devblog_06.png',
            ],
            [
                'title' => 'Devblog #7 — Donjon : Le Sanctuaire de la Sphinge',
                'content' => "Une nouvelle faille s’est ouverte dans les terres oubliées. Les éclaireurs parlent d’un sanctuaire ancien, scellé depuis des siècles, gardé par une entité aussi majestueuse que redoutable : la Sphinge. Ce donjon marque une étape importante dans l’évolution du contenu PvE, mêlant énigmes, narration et affrontement stratégique.

                [Objectifs du donjon]
                - Introduire une expérience de raid plus cérébrale, centrée sur la réflexion et la coordination
                - Tester les mécaniques de résolution d’énigmes en groupe
                - Déployer un boss à phases multiples, avec des comportements adaptatifs
                
                [Fonctionnement]
                - Le donjon est accessible à partir du niveau 20 via une quête d’exploration
                - Il se compose de trois salles d’énigmes à résoudre en équipe avant d’accéder à la chambre de la Sphinge
                - La Sphinge alterne entre phases de combat physique et phases de questions mystiques, où les mauvaises réponses peuvent affaiblir le groupe ou renforcer le boss
                - Des récompenses uniques sont disponibles : artefacts antiques, fragments de savoir, et équipements liés aux déités
                
                [Retours des premiers testeurs]
                - L’ambiance est jugée “immersive et mystérieuse”
                - Les énigmes “obligent à communiquer et réfléchir en groupe”
                - Le combat final est “intense, mais gratifiant une fois compris”
                
                [Prochaines évolutions]
                - Ajout d’un mode héroïque avec énigmes aléatoires et timer
                - Intégration de répliques vocales pour la Sphinge, liées aux choix de déité
                - Déploiement d’un classement des équipes ayant vaincu la Sphinge avec le meilleur score
                
                Ce donjon marque une rupture avec les affrontements classiques : ici, la force brute ne suffit pas. Il faudra écouter, réfléchir, et parfois… répondre à l’inattendu. La Sphinge ne protège pas un trésor, elle protège un savoir.
                À suivre dans le Devblog #8...",
                'date' => '2025-09-7',
                'image' => 'devblog_07.png',
            ],
            [
                'title' => 'Devblog #8 — Montagnes du Nord : l’invasion orc commence',
                'content' => "Une nouvelle zone vient d’être ouverte aux joueurs : les montagnes du nord, territoire sauvage, escarpé et longtemps resté inaccessible. Mais cette expansion n’est pas qu’un ajout géographique : elle marque le début d’un arc narratif majeur. Les orcs, jusqu’ici cantonnés aux hauteurs, ont commencé à descendre vers les plaines, pillant les villages et se dirigeant lentement vers le sud.
                
                [Objectifs de cette zone]
                - Étendre la carte du monde avec un environnement hostile et vertical
                - Introduire une faction ennemie dynamique avec des comportements évolutifs
                - Déployer des événements d’invasion affectant les zones déjà explorées
                
                [Fonctionnement]
                - La zone est accessible à partir du niveau 25 via une mission de reconnaissance
                - Les orcs sont organisés en clans rivaux, chacun avec ses tactiques et ses chefs
                - Des villages humains en bordure peuvent être attaqués en temps réel, déclenchant des quêtes de défense
                - Les joueurs peuvent choisir de repousser les assauts, infiltrer les camps ennemis ou suivre les traces des éclaireurs orcs
                
                [Retours des premiers explorateurs]
                - Le relief montagneux est “impressionnant et exigeant”
                - Les attaques orcs sont “imprévisibles et bien rythmées”
                - L’ambiance sonore et visuelle est “plus sombre, plus tendue, plus immersive”
                
                [Prochaines évolutions]
                - Ajout de forteresses orcs à capturer en groupe
                - Déploiement d’un système de réputation lié aux clans ennemis
                - Intégration d’un événement mondial : la marche vers le sud
                
                Ce Devblog marque le début d’un conflit ouvert. Les orcs ne sont plus des créatures isolées : ils s’organisent, avancent, et menacent l’équilibre du monde. Il ne s’agit plus seulement d’explorer… il faudra défendre.
                À suivre dans le Devblog #9...",
                'date' => '2025-09-8',
                'image' => 'devblog_08.png',
            ],
        ];

        foreach ($entries as $entry) {
            $slug = $slugify->slugify($entry['title']);
            $existing = $this->em->getRepository(Devblog::class)->findOneBy(['slug' => $slug]);

            if ($existing) {
                $output->writeln("❌ Devblog déjà présent : {$entry['title']}");
                continue;
            }

            $devblog = new Devblog();
            $devblog->setTitle($entry['title']);
            $devblog->setContent($entry['content']);
            $devblog->setDate(new \DateTime($entry['date']));
            $devblog->setImage($entry['image']);
            $devblog->setSlug($slug);

            $this->em->persist($devblog);
            $output->writeln("✅ Devblog injecté : {$entry['title']}");
        }

        $this->em->flush();
        $output->writeln('🎉 Tous les devblogs ont été traités.');
        return Command::SUCCESS;
    }
}