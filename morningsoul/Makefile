.PHONY: seed promote demote

# Commandes Docker
DOCKER_PHP=docker exec -it symfony_php php

# Commandes locales
LOCAL_PHP=php

# Super admin
# promote:
# 	$(DOCKER_PHP) bin/console app:promote-super-admin superadmin@superadmin.fr

# demote:
# 	$(DOCKER_PHP) bin/console app:demote-super-admin superadmin@superadmin.com

# Seed global
seed: promote demote
	$(DOCKER_PHP) bin/console app:seed-tags
	$(DOCKER_PHP) bin/console app:seed-forum-sections
	$(DOCKER_PHP) bin/console app:seed-changelog
	$(DOCKER_PHP) bin/console app:seed-devblog
	$(DOCKER_PHP) bin/console app:seed-presentations
	$(DOCKER_PHP) bin/console app:seed-user superadmin@superadmin.fr SuperAdmin WQA123XSZ987edc@ ROLE_SUPER_ADMIN