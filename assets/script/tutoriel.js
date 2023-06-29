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
        id: 'step3',
        attachTo: {
            element: '.es-sidebar-faq',
            on: 'bottom',
        },
    canClickTarget: false,
    modalOverlayOpeningPadding: 10,
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
        id: 'step4',
        attachTo: {
            element: '.es-sidebar-contact',
            on: 'bottom',
        },
    canClickTarget: false,
    modalOverlayOpeningPadding: 30,
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
        id: 'step5',
        attachTo: {
            element: '.es-sidebar-logout',
            on: 'top',
        },
    canClickTarget: false,
    modalOverlayOpeningPadding: 10,
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
        id: 'step6',

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
                action: tour.next,
            },
        ],
    }
);


// Démarrez le tutoriel
if (window.location.pathname === '/accueil') {
    // Votre code JavaScript spécifique à la page "page.html.twig" ici
    tour.start();
}

