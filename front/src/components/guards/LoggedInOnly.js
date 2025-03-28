import auth from '@/Model/AuthInstance';

export default {
  name: 'LoggedInOnly',
  functional: true,

  props: {
    displayError: Boolean,
  },

  render(h, context) {
    const isLoggedIn = auth?.loggedIn;

    if (isLoggedIn) {
      return context.children;
    }

    return context.props.displayError
      ? <b-alert variant="danger" show class="text-center">Brak dostępu</b-alert>
      : null;
  }
};
