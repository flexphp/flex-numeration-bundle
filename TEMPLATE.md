TEMPLATE
___

# Clone Repository

```bash
cd /var/www/html/flexphp
cp -pr flex-skeleton-bundle flex-{name}-bundle
cd flex-{name}-bundle
rm .git -Rf
git init
git add .
```
# Move Files

```bash
mv src/FlexPHPSkeletonBundle.php src/FlexPHP{Name}Bundle.php
mv src/DependencyInjection/FlexPHPSkeletonExtension.php src/DependencyInjection/FlexPHP{Name}Extension.php
```

# Replace Names

```bash
grep -rls "skeleton" | xargs sed -i 's/skeleton/{name}/g'
grep -rls "Skeleton" | xargs sed -i 's/Skeleton/{Name}/g'

# or

vim
e README.md
%s#skeleton#{name}#g
%s#Skeleton#{Name}#g

e composer.json
%s#skeleton#{name}#g
%s#Skeleton#{Name}#g

e config/services.xml
%s#skeleton#{name}#g
%s#Skeleton#{Name}#g

e config/routes.xml
%s#skeleton#{name}#g
%s#Skeleton#{Name}#g

e src/DependencyInjection/ConfigSchema.php
%s#skeleton#{name}#g
%s#Skeleton#{Name}#g

e src/FlexPHP{Name}Bundle.php
%s#Skeleton#{Name}#g

e src/DependencyInjection/FlexPHP{Name}Extension.php
%s#Skeleton#{Name}#g
```

# Commiting

```bash
git add .
git commit -m "Initial commit"
```

# Branching

```bash
git flow init -d
```

# Using this script

```bash
s#{name}##g
s#{Name}##g
```

# After Flex Generator

```bash
# Move files
mv /var/www/html/flexphp/flex-generator/src/tmp/{Name}/templates /var/www/html/flexphp/flex-{name}-bundle/
mv /var/www/html/flexphp/flex-generator/src/tmp/{Name}/translations /var/www/html/flexphp/flex-{name}-bundle/
mv /var/www/html/flexphp/flex-generator/src/tmp/{Name}/yamls /var/www/html/flexphp/flex-{name}-bundle/
mv /var/www/html/flexphp/flex-generator/src/tmp/{Name}/domain/* /var/www/html/flexphp/flex-{name}-bundle/src/Domain
mv /var/www/html/flexphp/flex-generator/src/tmp/{Name}/src/Controller /var/www/html/flexphp/flex-{name}-bundle/src

# Update namespaces by folder
## Controller
grep -rlsF "namespace App\\" src/Controller/ | xargs sed -i 's#namespace App\\#namespace FlexPHP\\Bundle\\{Name}Bundle\\#g'
grep -rlsF "use Domain\\" src/Controller/ | xargs sed -i 's#use Domain\\#use FlexPHP\\Bundle\\{Name}Bundle\\Domain\\#g'

## Domain
grep -rlsF "namespace Domain\\" src/Domain/ | xargs sed -i 's#namespace Domain\\#namespace FlexPHP\\Bundle\\{Name}Bundle\\Domain\\#g'
grep -rlsF "use Domain\\" src/Domain/ | xargs sed -i 's#use Domain\\#use FlexPHP\\Bundle\\{Name}Bundle\\Domain\\#g'

## Optional (Helper, User, Location bundles)
grep -rlsF "use Domain\\Helper\\" src/Domain/ | xargs sed -i 's#use Domain\\Helper\\#use FlexPHP\\Bundle\\HelperBundle\\Domain\\Helper\\#g'

grep -rlsF "use Domain\\User\\" src/Domain/ | xargs sed -i 's#use Domain\\User\\#use FlexPHP\\Bundle\\UserBundle\\Domain\\User\\#g'
grep -rlsF "use Domain\\UserStatus\\" src/Domain/ | xargs sed -i 's#use Domain\\UserStatus\\#use FlexPHP\\Bundle\\UserBundle\\Domain\\User\\#g'

grep -rlsF "use Domain\\Currency\\" src/Domain | xargs sed -i 's#use Domain\\Currency\\#use FlexPHP\\Bundle\\LocationBundle\\Domain\\Currency\\#g'
grep -rlsF "use Domain\\DocumentType\\" src/Domain | xargs sed -i 's#use Domain\\DocumentType\\#use FlexPHP\\Bundle\\LocationBundle\\Domain\\DocumentType\\#g'
grep -rlsF "use Domain\\PaymentMethod\\" src/Domain | xargs sed -i 's#use Domain\\PaymentMethod\\#use FlexPHP\\Bundle\\LocationBundle\\Domain\\PaymentMethod\\#g'
grep -rlsF "use Domain\\Country\\" src/Domain | xargs sed -i 's#use Domain\\Country\\#use FlexPHP\\Bundle\\LocationBundle\\Domain\\Country\\#g'
grep -rlsF "use Domain\\State\\" src/Domain | xargs sed -i 's#use Domain\\State\\#use FlexPHP\\Bundle\\LocationBundle\\Domain\\State\\#g'
grep -rlsF "use Domain\\City\\" src/Domain | xargs sed -i 's#use Domain\\City\\#use FlexPHP\\Bundle\\LocationBundle\\Domain\\City\\#g'
```

## From Bundle

```bash
grep -rlsF "use FlexPHP\\Bundle\\PayrollBundle\\Domain\\Helper\\" src/Domain | xargs sed -i 's#use FlexPHP\\Bundle\\PayrollBundle\\Domain\\Helper\\#use FlexPHP\\Bundle\\HelperBundle\\Domain\\Helper\\#g'
grep -rlsF "use FlexPHP\\Bundle\\PayrollBundle\\Domain\\User\\" src/Domain | xargs sed -i 's#use FlexPHP\\Bundle\\PayrollBundle\\Domain\\User\\#use FlexPHP\\Bundle\\UserBundle\\Domain\\User\\#g'
grep -rlsF "use FlexPHP\\Bundle\\PayrollBundle\\Domain\\Currency\\" src/Domain | xargs sed -i 's#use FlexPHP\\Bundle\\PayrollBundle\\Domain\\Currency\\#use FlexPHP\\Bundle\\LocationBundle\\Domain\\Currency\\#g'
grep -rlsF "use FlexPHP\\Bundle\\PayrollBundle\\Domain\\Provider\\" src/Domain | xargs sed -i 's#use FlexPHP\\Bundle\\PayrollBundle\\Domain\\Provider\\#use FlexPHP\\Bundle\\NumerationBundle\\Domain\\Provider\\#g'
```

## From Projects

```bash

mv /var/www/html/{project}/templates/{file} /var/www/html/flexphp/flex-{name}-bundle/templates
mv /var/www/html/{project}/translations/{file}.*.php /var/www/html/flexphp/flex-{name}-bundle/translations
mv /var/www/html/{project}/yamls/{files}.yaml /var/www/html/flexphp/flex-{name}-bundle/yamls
mv /var/www/html/{project}/domain/{File} /var/www/html/flexphp/flex-{name}-bundle/src/Domain
mv /var/www/html/{project}/src/Controller/{File}Controller.php /var/www/html/flexphp/flex-{name}-bundle/src/Controller

grep -rlsF "use Domain\\{File}\\" domain | xargs sed -i 's#use Domain\\{File}\\#use FlexPHP\\Bundle\\{Name}Bundle\\Domain\\{File}\\#g'

```

## Routes

```bash

e src/Controller/{File}Controller.php
g/@Route/d

grep -rlsF "{fi-les}." src/Controller/{File}Controller.php templates/{file}/ src/Domain | xargs sed -i "s#{fi-les}\\.#flexphp.{name}.\\0#g"

grep -rlsF "{file}/" src/Controller/{File}Controller.php templates/{file}/ | xargs sed -i "s#{file}/#@FlexPHP{Name}/\\0#g"

ga public/js/{file}s.js src/Controller/{File}Controller.php templates/{file}/ src/Domain/{File}/ translations/{file}.*.php yamls/{files}.yaml

ga config/routes.xml config/services.xml

```
> s#{name}##g
> s#{Name}##g
> s#{file}##g
> s#{files}##g
> s#{fi-les}##g
> s#{File}##g

## Example

mv /var/www/html/flexphp/flex-generator/src/tmp/Payroll/public/js/payrolls.js public/js

e src/Controller/PayrollController.php
g/@Route/d

grep -rlsF "payrolls." src/Controller/PayrollController.php templates/payroll/ src/Domain | xargs sed -i "s#payrolls\\.#flexphp.payroll.\\0#g"
grep -rlsF "payroll/" src/Controller/PayrollController.php templates/payroll/ | xargs sed -i "s#payroll/#@FlexPHPPayroll/\\0#g"

ga public/js/payrolls.js src/Controller/PayrollController.php templates/payroll/ src/Domain/Payroll/ translations/payroll.*.php yamls/payrolls.yaml

ga config/routes.xml config/services.xml

rm -fR /var/www/html/flexphp/flex-payroll-bundle/src/Domain/Agreement/*
mv -f /var/www/html/flexphp/flex-generator/src/tmp/Payroll/templates/agreement/* /var/www/html/flexphp/flex-payroll-bundle/templates/agreement
mv -f /var/www/html/flexphp/flex-generator/src/tmp/Payroll/translations/agreement.*.php /var/www/html/flexphp/flex-payroll-bundle/translations
mv -f /var/www/html/flexphp/flex-generator/src/tmp/Payroll/yamls/agreements.yaml /var/www/html/flexphp/flex-payroll-bundle/yamls
mv -f /var/www/html/flexphp/flex-generator/src/tmp/Payroll/domain/Agreement/* /var/www/html/flexphp/flex-payroll-bundle/src/Domain/Agreement
mv -f /var/www/html/flexphp/flex-generator/src/tmp/Payroll/src/Controller/AgreementController.php /var/www/html/flexphp/flex-payroll-bundle/src/Controller

grep -rlsF "namespace App\\" src/Controller/ | xargs sed -i 's#namespace App\\#namespace FlexPHP\\Bundle\\PayrollBundle\\#g'
grep -rlsF "use Domain\\" src/Controller/ | xargs sed -i 's#use Domain\\#use FlexPHP\\Bundle\\PayrollBundle\\Domain\\#g'
grep -rlsF "namespace Domain\\" src/Domain/ | xargs sed -i 's#namespace Domain\\#namespace FlexPHP\\Bundle\\PayrollBundle\\Domain\\#g'
grep -rlsF "use Domain\\" src/Domain/ | xargs sed -i 's#use Domain\\#use FlexPHP\\Bundle\\PayrollBundle\\Domain\\#g'
