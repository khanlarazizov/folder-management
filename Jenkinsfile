node {
    
    deleteDir()
    APP_NAME="fms-app"
    PROJECT="fms"
    
    if (env.BRANCH_NAME == 'testing'){
        RESOURCE_NAME="$APP_NAME"+"-t"
        NAMESPACE="$PROJECT-test"
        KUBEFILE="/var/lib/jenkins/.kube/kripton"
    }

    if (env.BRANCH_NAME == 'staging'){
        RESOURCE_NAME="$APP_NAME"+"-s"
        NAMESPACE="$PROJECT-staging"
        KUBEFILE="/var/lib/jenkins/.kube/kripton"
    }

    if (env.BRANCH_NAME == 'master'){
        RESOURCE_NAME="$APP_NAME"+"-p"
        NAMESPACE="$PROJECT-prod"
        KUBEFILE="/var/lib/jenkins/.kube/$PROJECT"
    }

    try {
        stage ('Checkout') {
        	checkout scm
        }
       
        if ((env.BRANCH_NAME == 'testing' || env.BRANCH_NAME == 'master' || env.BRANCH_NAME == 'staging') && (env.GITLAB_OBJECT_KIND == 'none' || env.GITLAB_OBJECT_KIND == 'push')) {
            stage ('Build Image') {
				sh "docker build -t hub.kripton.az/$PROJECT/$RESOURCE_NAME:v${env.BUILD_NUMBER} ."
            }
			
      	    stage ('Push&Clean Image') {
				sh "docker push hub.kripton.az/$PROJECT/$RESOURCE_NAME:v${env.BUILD_NUMBER}"
				sh "docker rmi -f hub.kripton.az/$PROJECT/$RESOURCE_NAME:v${env.BUILD_NUMBER}"
			}
			
            stage ('deploy') {
               sh "kubectl  --kubeconfig $KUBEFILE --record deployment.apps/$RESOURCE_NAME set image deployment.apps/$RESOURCE_NAME $APP_NAME=hub.kripton.az/$PROJECT/$RESOURCE_NAME:v${env.BUILD_NUMBER} -n $NAMESPACE"
			   sh "kubectl --kubeconfig $KUBEFILE rollout status deployment/$RESOURCE_NAME -n $NAMESPACE"
            }   
        }
    } catch (err) {
        throw err
    }
}
