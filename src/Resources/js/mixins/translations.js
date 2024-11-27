export const translations = {
    data() {
        return {
            cachedTranslations: {},
        };
    },
    created() {
        if (this.$page?.props?.translations) {
            this.cachedTranslations = this.$page.props.translations;
        }
    },
    methods: {
        __(key, replacements = {}, trans = this.cachedTranslations) {
            let translation = trans[key] || key;

            Object.keys(replacements).forEach((placeholder) => {
                translation = translation.replace(`:${placeholder}`, replacements[placeholder]);
            });

            return translation;
        }
    }
}
