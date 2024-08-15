import {Controller} from '@hotwired/stimulus';

export default class extends Controller {

  static targets = ['themeSwitch', 'themeIcon']

  declare readonly themeIconTarget: HTMLLabelElement;

  private DEFAULT_THEME = 'dark';
  private ICON_LIGHT = ['bi-sun-fill', 'text-warning'];
  private ICON_DARK = ['bi-moon-stars-fill'];

  connect() {
    let theme = localStorage.getItem('preferred_theme');
    this.updateTheme(theme);
  }

  changeTheme() {
    let theme = localStorage.getItem('preferred_theme');
    theme = theme === 'dark' ? 'light' : 'dark';
    this.updateTheme(theme);
  }

  private updateTheme(theme: string | null) {
    if (theme === null) {
      theme = this.DEFAULT_THEME;
    }
    document.documentElement.setAttribute('data-bs-theme', theme);

    this.themeIconTarget.classList.remove(...(theme === 'dark' ? this.ICON_LIGHT : this.ICON_DARK));
    this.themeIconTarget.classList.add(...(theme === 'dark' ? this.ICON_DARK : this.ICON_LIGHT));

    localStorage.setItem('preferred_theme', theme);
  }
}
