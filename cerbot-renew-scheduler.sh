set -x
export $(egrep -v '^#' .env | xargs)


URL="https://api.mailgun.net/v3/$MG_DOMAIN/messages"
curl --user "api:$MG_KEY" "$URL" -F from="$EMAIL_FROM" -F to="$EMAIL_TO" -F subject='LetsEncrypt certs auto renewel attempt' -F text='LetsEncrypt certs auto renewel attempt'


echo "" > /tmp/tmp.txt
cd /etc/letsencrypt/ && ./certbot-auto renew 2>&1 | tee /tmp/tmp.txt
gcloud compute instances list --filter="name~'$INSTANCE_GROUP_NAME'" --format="value(name)" \
|xargs -I '{}' gcloud compute ssh '{}' --zone='europe-west2-c' --command "sudo service apache2 restart"

MSG=$(cat /tmp/tmp.txt)
curl --user "api:$MG_KEY" "$URL" -F from="$EMAIL_FROM" -F to="$EMAIL_TO" -F subject='LetsEncrypt certs auto renewel attempted' -F text="$MSG"


 