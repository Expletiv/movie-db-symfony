import {Controller} from '@hotwired/stimulus';

export default class extends Controller {

  static targets = ['themeSwitch']

  declare readonly themeSwitchTarget: HTMLInputElement;

  private DEFAULT_THEME = 'dark';

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
    localStorage.setItem('preferred_theme', theme);
    this.themeSwitchTarget.checked = theme === 'dark';
  }
}
