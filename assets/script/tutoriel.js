const tour = new Shepherd.Tour({
    defaultStepOptions: {
        scrollTo: false,
        showCancelLink: true,
        cancelIcon: {
            enabled: true
        },
    },
    useModalOverlay: true,
});

// Ajoutez les étapes du tutoriel
tour.addStep({
    id: 'step1',
    title: 'Introduction à l\'application',
    text: 'Bienvenue sur Estimmaüs ! Ce tutoriel va vous permettre de découvrir les fonctionnalités de l\'application. Appuez sur le bouton "Suivant" pour continuer.',
    buttons: [
        {
            text: 'Suivant',
            action: tour.next,
        },
    ],
});

tour.addStep({
        id: 'step2',
        attachTo: {
            element: '.es-sidebar-logo',
            on: 'bottom',
        },
        canClickTarget: false,
        title: 'Navigation',
        text: 'Voici le logo du site. Il est très utile pour la navigation, car vous pouvez cliquer dessus pour revenir sur cette page.',
        buttons: [
            {
                action() {
                    return this.back();
                },
                classes: 'shepherd-button-secondary',
                text: 'Retour arrière'
            },
            {
                text: 'Suivant',
                action: tour.next,
            },
        ],
    }
);

tour.addStep({
    id: 'step3',
    attachTo: {
        element: '.es-sidebar-estimation',
        on: 'bottom',
    },
    canClickTarget: false,
    title: 'Faire une estimation',
    text: 'Cet onglet vous envoie vers la page destinée à l\'estimation d\'un téléphone.',
    buttons: [
        {
            action() {
                return this.back();
            },
            classes: 'shepherd-button-secondary',
            text: 'Retour arrière'
        },
        {
            text: 'Suivant',
            action: tour.next,
        },
    ],
});
tour.addStep({
        id: 'step4',
        attachTo: {
            element: '.es-sidebar-faq',
            on: 'bottom',
        },
    canClickTarget: false,
        title: 'Foire aux questions',
        text: 'Cet onglet vous envoie vers les questions fréquemment posées, vous y trouverez certainement vos réponses !',
        buttons: [
            {
                action() {
                    return this.back();
                },
                classes: 'shepherd-button-secondary',
                text: 'Retour arrière'
            },
            {
                text: 'Suivant',
                action: tour.next,
            },
        ],
    }
);

tour.addStep({
        id: 'step5',
        attachTo: {
            element: '.es-sidebar-contact',
            on: 'bottom',
        },
    canClickTarget: false,
        title: 'Contact',
        text: 'Cet onglet vous envoie vers la page pour contacter un administrateur, si vous avez des questions ou des suggestions.',
        buttons: [
            {
                action() {
                    return this.back();
                },
                classes: 'shepherd-button-secondary',
                text: 'Retour arrière'
            },
            {
                text: 'Suivant',
                action: tour.next,
            },
        ],
    }
);

tour.addStep({
        id: 'step6',
        attachTo: {
            element: '.es-sidebar-logout',
            on: 'top',
        },
    canClickTarget: false,
        title: 'Se déconnecter',
        text: 'Ce bouton sert à vous déconnecter de l\'application, cliquez dessus quand vous avez fini de vous en servir.',
        buttons: [
            {
                action() {
                    return this.back();
                },
                classes: 'shepherd-button-secondary',
                text: 'Retour arrière'
            },
            {
                text: 'Suivant',
                action: tour.next,
            },
        ],
    }
);

tour.addStep({
        id: 'step7',

        title: 'En route !',
        text: 'Et voilà ! vous savez désormais comment utiliser cette aplication. Vous pouvez rejouer ce tutoriel à tout moment en cliquant sur le bouton associé dans l\'onglet de la Foire aux Questions. Bonne navigation !',
        buttons: [
            {
                action() {
                    return this.back();
                },
                classes: 'shepherd-button-secondary',
                text: 'Retour arrière'
            },
            {
                text: 'Fermer',
                action() {
                    dismissTour();
                    return this.hide();
                }
            },
        ],
    }
);

function dismissTour() {
    if (!localStorage.getItem('shepherd-tour')) {
        localStorage.setItem('shepherd-tour', 'yes');
    }
}

// Dismiss the tour when the cancel icon is clicked. Do not show the tour on next page reload
tour.on('cancel', dismissTour);

// Initiate the tour
if (!localStorage.getItem('shepherd-tour') && window.location.pathname === '/accueil') {
    tour.start();
}

// Sélectionnez le bouton "reset" à l'aide de son ID
const resetButton = document.getElementById('reset-tour-button');

// Ajoutez un gestionnaire d'événements pour le clic sur le bouton "reset"
resetButton.addEventListener('click', resetTour);

// Fonction pour réinitialiser le localStorage
function resetTour() {
    localStorage.removeItem('shepherd-tour');
}

