const tour = new Shepherd.Tour({
    defaultStepOptions: {
        scrollTo: true,
        showCancelLink: true,
        cancelIcon: {
            enabled: true
        },
    },
    scrollTo: { behavior: 'smooth', block: 'center' },
    useModalOverlay: true,
});

// Ajoutez les étapes du tutoriel
tour.addStep({
    id: 'step1',
    attachTo: {
        element: '.ec-img-landing-page',
        on: 'right',
    },
    title: 'Introduction à l\'application',
    text: 'Bienvenue sur Estimmaüs ! Aline est la GOAT de tous les temps',
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
        element: '.ec-button-start',
        on: 'left',
    },
    title: 'Introduction à l\'application',
    text: 'Réel masterclass ',
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


// Démarrez le tutoriel
tour.start();
